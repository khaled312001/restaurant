<?php

namespace App\Helpers;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use BaconQrCode\Exception\WriterException;
use BaconQrCode\Renderer\Color\Alpha;
use BaconQrCode\Renderer\Color\ColorInterface;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Eye\EyeInterface;
use BaconQrCode\Renderer\Eye\ModuleEye;
use BaconQrCode\Renderer\Eye\SimpleCircleEye;
use BaconQrCode\Renderer\Eye\SquareEye;
use BaconQrCode\Renderer\Image\EpsImageBackEnd;
use BaconQrCode\Renderer\Image\ImageBackEndInterface;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Module\DotsModule;
use BaconQrCode\Renderer\Module\ModuleInterface;
use BaconQrCode\Renderer\Module\RoundnessModule;
use BaconQrCode\Renderer\Module\SquareModule;
use BaconQrCode\Renderer\RendererStyle\EyeFill;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\Gradient;
use BaconQrCode\Renderer\RendererStyle\GradientType;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BadMethodCallException;
use InvalidArgumentException;
use SimpleSoftwareIO\QrCode\DataTypes\DataTypeInterface;

class QrCodeGenerator
{
    /**
     * Holds the selected formatter.
     *
     * @var string
     */
    protected $format = 'svg';

    /**
     * Holds the size of the QrCode in pixels.
     *
     * @var int
     */
    protected $pixels = 100;

    /**
     * Holds the margin size of the QrCode.
     *
     * @var int
     */
    protected $margin = 0;

    /**
     * Holds the selected error correction.
     * L: 7% loss.
     * M: 15% loss.
     * Q: 25% loss.
     * H: 30% loss.
     *
     * @var string|null
     */
    protected $errorCorrection = null;

    /**
     * Holds the selected encoder.
     *
     * @var string
     */
    protected $encoding = Encoder::DEFAULT_BYTE_MODE_ECODING;

    /**
     * The style of the blocks within the QrCode.
     * Possible values are square, dot, and round.
     *
     * @var string
     */
    protected $style = 'square';

    /**
     * The size of the selected style between 0 and 1.
     * This only applies to dot and round.
     *
     * @var float|null
     */
    protected $styleSize = null;

    /**
     * The style to apply to the eye.
     * Possible values are circle and square.
     *
     * @var string|null
     */
    protected $eyeStyle = null;

    /**
     * Holds the foreground color.
     *
     * @var ColorInterface|null
     */
    protected $color = null;

    /**
     * Holds the background color.
     *
     * @var ColorInterface|null
     */
    protected $backgroundColor = null;

    /**
     * Holds the eye colors.
     *
     * @var array
     */
    protected $eyeColors = [];

    /**
     * Holds the gradient.
     *
     * @var Gradient|null
     */
    protected $gradient = null;

    /**
     * Holds an image string that will be merged with the QrCode.
     *
     * @var string|null
     */
    protected $imageMerge = null;

    /**
     * The percentage of the QrCode that the merged image should take up.
     *
     * @var float
     */
    protected $imagePercentage = 0.2;

    /**
     * Creates a new datatype object and then generates a QrCode.
     *
     * @param string $method
     * @param array $arguments
     * @return string
     */
    public function __call($method, array $arguments)
    {
        $class = $this->createClass($method);

        return $this->generate($class->create($arguments));
    }

    /**
     * Generates the QrCode.
     *
     * @param string $text
     * @param string|null $filename
     * @return string
     */
    public function generate(string $text, string $filename = null)
    {
        // Set default error correction if not set
        if ($this->errorCorrection === null) {
            $this->errorCorrection = ErrorCorrectionLevel::H();
        }
        
        $qrCode = $this->getWriter($this->getRenderer())->writeString($text, $this->encoding, $this->errorCorrection);

        if ($this->imageMerge) {
            $merger = new \SimpleSoftwareIO\QrCode\ImageMerge(new \SimpleSoftwareIO\QrCode\Image($qrCode), new \SimpleSoftwareIO\QrCode\Image($this->imageMerge));
            $qrCode = $merger->merge($this->imagePercentage);
        }

        if ($filename) {
            file_put_contents($filename, $qrCode);
        }

        if ($this->format === 'svg') {
            return new \Illuminate\Support\HtmlString($qrCode);
        }

        return $qrCode;
    }

    /**
     * Merges an image over the QrCode.
     *
     * @param string $filepath
     * @param float $percentage
     * @param bool $absolute
     * @return $this
     */
    public function merge(string $filepath, float $percentage = .2, bool $absolute = false): self
    {
        if ($absolute) {
            $this->imageMerge = file_get_contents($filepath);
        } else {
            $this->imageMerge = file_get_contents(public_path($filepath));
        }

        $this->imagePercentage = $percentage;

        return $this;
    }

    /**
     * Merges an image string with the center of the QrCode.
     *
     * @param string $content
     * @param float $percentage
     * @return $this
     */
    public function mergeString(string $content, float $percentage = .2): self
    {
        $this->imageMerge = $content;
        $this->imagePercentage = $percentage;

        return $this;
    }

    /**
     * Sets the size of the QrCode.
     *
     * @param int $pixels
     * @return $this
     */
    public function size(int $pixels): self
    {
        $this->pixels = $pixels;

        return $this;
    }

    /**
     * Sets the format of the QrCode.
     *
     * @param string $format
     * @return $this
     */
    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Sets the foreground color of the QrCode.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int|null $alpha
     * @return $this
     */
    public function color(int $red, int $green, int $blue, ?int $alpha = null): self
    {
        $this->color = $this->createColor($red, $green, $blue, $alpha);

        return $this;
    }

    /**
     * Sets the background color of the QrCode.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int|null $alpha
     * @return $this
     */
    public function backgroundColor(int $red, int $green, int $blue, ?int $alpha = null): self
    {
        $this->backgroundColor = $this->createColor($red, $green, $blue, $alpha);

        return $this;
    }

    /**
     * Sets the eye color of the QrCode.
     *
     * @param int $eyeNumber
     * @param int $innerRed
     * @param int $innerGreen
     * @param int $innerBlue
     * @param int $outterRed
     * @param int $outterGreen
     * @param int $outterBlue
     * @return $this
     */
    public function eyeColor(int $eyeNumber, int $innerRed, int $innerGreen, int $innerBlue, int $outterRed = 0, int $outterGreen = 0, int $outterBlue = 0): self
    {
        $this->eyeColors[$eyeNumber] = new EyeFill(
            $this->createColor($outterRed, $outterGreen, $outterBlue),
            $this->createColor($innerRed, $innerGreen, $innerBlue)
        );

        return $this;
    }

    /**
     * Sets the gradient of the QrCode.
     *
     * @param int $startRed
     * @param int $startGreen
     * @param int $startBlue
     * @param int $endRed
     * @param int $endGreen
     * @param int $endBlue
     * @param string $type
     * @return $this
     */
    public function gradient($startRed, $startGreen, $startBlue, $endRed, $endGreen, $endBlue, string $type): self
    {
        $this->gradient = new Gradient(
            $this->createColor($startRed, $startGreen, $startBlue),
            $this->createColor($endRed, $endGreen, $endBlue),
            $type === 'radial' ? GradientType::radial() : GradientType::linear()
        );

        return $this;
    }

    /**
     * Sets the eye style of the QrCode.
     *
     * @param string $style
     * @return $this
     */
    public function eye(string $style): self
    {
        $this->eyeStyle = $style;

        return $this;
    }

    /**
     * Sets the style of the blocks within the QrCode.
     *
     * @param string $style
     * @param float $size
     * @return $this
     */
    public function style(string $style, float $size = 0.5): self
    {
        $this->style = $style;
        $this->styleSize = $size;

        return $this;
    }

    /**
     * Sets the encoding for the QrCode.
     *
     * @param string $encoding
     * @return $this
     */
    public function encoding(string $encoding): self
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Sets the error correction for the QrCode.
     *
     * @param string $errorCorrection
     * @return $this
     */
    public function errorCorrection(string $errorCorrection): self
    {
        switch (strtoupper($errorCorrection)) {
            case 'L':
                $this->errorCorrection = ErrorCorrectionLevel::L();
                break;
            case 'M':
                $this->errorCorrection = ErrorCorrectionLevel::M();
                break;
            case 'Q':
                $this->errorCorrection = ErrorCorrectionLevel::Q();
                break;
            case 'H':
                $this->errorCorrection = ErrorCorrectionLevel::H();
                break;
            default:
                $this->errorCorrection = ErrorCorrectionLevel::H();
        }

        return $this;
    }

    /**
     * Sets the margin of the QrCode.
     *
     * @param int $margin
     * @return $this
     */
    public function margin(int $margin): self
    {
        $this->margin = $margin;

        return $this;
    }

    /**
     * Gets the writer.
     *
     * @param ImageRenderer $renderer
     * @return Writer
     */
    public function getWriter(ImageRenderer $renderer): Writer
    {
        return new Writer($renderer);
    }

    /**
     * Gets the renderer.
     *
     * @return ImageRenderer
     */
    public function getRenderer(): ImageRenderer
    {
        return new ImageRenderer(
            $this->getRendererStyle(),
            $this->getFormatter()
        );
    }

    /**
     * Gets the renderer style.
     *
     * @return RendererStyle
     */
    public function getRendererStyle(): RendererStyle
    {
        return new RendererStyle($this->pixels, $this->margin);
    }

    /**
     * Gets the formatter.
     *
     * @return ImageBackEndInterface
     */
    public function getFormatter(): ImageBackEndInterface
    {
        if ($this->format === 'png') {
            // Check if imagick extension is available
            if (extension_loaded('imagick')) {
                return new ImagickImageBackEnd('png');
            } else {
                // Fallback to SVG if imagick is not available
                $this->format = 'svg';
                return new SvgImageBackEnd;
            }
        }

        if ($this->format === 'eps') {
            return new EpsImageBackEnd;
        }

        return new SvgImageBackEnd;
    }

    /**
     * Fetches the module.
     *
     * @return ModuleInterface
     */
    public function getModule(): ModuleInterface
    {
        if ($this->style === 'dot') {
            return new DotsModule($this->styleSize);
        }

        if ($this->style === 'round') {
            return new RoundnessModule($this->styleSize);
        }

        return SquareModule::instance();
    }

    /**
     * Fetches the eye style.
     *
     * @return EyeInterface
     */
    public function getEye(): EyeInterface
    {
        if ($this->eyeStyle === 'square') {
            return SquareEye::instance();
        }

        if ($this->eyeStyle === 'circle') {
            return SimpleCircleEye::instance();
        }

        return new ModuleEye($this->getModule());
    }

    /**
     * Fetches the color fill.
     *
     * @return Fill
     */
    public function getFill(): Fill
    {
        $foregroundColor = $this->color ?? new Rgb(0, 0, 0);
        $backgroundColor = $this->backgroundColor ?? new Rgb(255, 255, 255);
        $eye0 = $this->eyeColors[0] ?? EyeFill::inherit();
        $eye1 = $this->eyeColors[1] ?? EyeFill::inherit();
        $eye2 = $this->eyeColors[2] ?? EyeFill::inherit();

        if ($this->gradient) {
            return Fill::withForegroundGradient($backgroundColor, $this->gradient, $eye0, $eye1, $eye2);
        }

        return Fill::withForegroundColor($backgroundColor, $foregroundColor, $eye0, $eye1, $eye2);
    }

    /**
     * Creates a RGB or Alpha channel color.
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param null|int $alpha
     * @return ColorInterface
     */
    public function createColor(int $red, int $green, int $blue, ?int $alpha = null): ColorInterface
    {
        if (is_null($alpha)) {
            return new Rgb($red, $green, $blue);
        }

        return new Alpha($alpha, new Rgb($red, $green, $blue));
    }

    /**
     * Creates a new DataType class dynamically.
     *
     * @param string $method
     * @return DataTypeInterface
     */
    protected function createClass(string $method): DataTypeInterface
    {
        $class = $this->formatClass($method);

        if (! class_exists($class)) {
            throw new BadMethodCallException();
        }

        return new $class;
    }

    /**
     * Formats the class name.
     *
     * @param string $method
     * @return string
     */
    protected function formatClass(string $method): string
    {
        $class = "SimpleSoftwareIO\QrCode\DataTypes\\".$method;

        return $class;
    }
} 