# Meal Image Generator Script

This script automatically generates high-quality, professional-looking images for all meals in your King Kebab restaurant management system.

## Features

- **Automatic Image Generation**: Creates unique images for each meal based on category and name
- **Category-Based Colors**: Different color schemes for different meal types (burgers, desserts, beverages, etc.)
- **Professional Design**: Clean, modern design with decorative elements
- **Database Integration**: Automatically updates your database with new image names
- **Backup System**: Creates backups of existing images before replacing them
- **Comprehensive Logging**: Detailed logs of all operations
- **Multi-Language Support**: Works with both English and Arabic meal names

## Requirements

- PHP 7.4 or higher
- GD extension enabled
- PDO MySQL extension enabled
- MySQL/MariaDB database
- Write permissions to the image directories

## Installation

1. **Place the script files** in your King Kebab project root directory:
   - `simple_meal_image_downloader.php` - Main script
   - `meal_image_config.php` - Configuration file
   - `README_MEAL_IMAGES.md` - This documentation

2. **Configure your database settings** in `meal_image_config.php`:
   ```php
   'database' => [
       'host' => 'localhost',
       'database' => 'your_database_name',
       'username' => 'your_username',
       'password' => 'your_password'
   ]
   ```

3. **Optional**: Add a TTF font file (e.g., `arial.ttf`) to your project root for better text rendering

## Usage

### Basic Usage

Run the script from your project root directory:

```bash
php simple_meal_image_downloader.php
```

### Advanced Usage

You can customize the script by modifying the configuration file:

1. **Image Dimensions**: Change width and height in the config
2. **Color Schemes**: Modify colors for different meal categories
3. **Text Settings**: Adjust font size, text length, etc.
4. **Decorative Elements**: Enable/disable circles, borders, gradients

## Configuration Options

### Image Settings
- **Width**: 800px (default)
- **Height**: 600px (default)
- **Format**: PNG with transparency support
- **Quality**: Maximum PNG compression

### Color Schemes
The script automatically selects colors based on meal categories:

- **Burgers**: Orange background
- **Desserts**: Pink background
- **Beverages**: Blue background
- **Set Menus**: Green background
- **Kebabs**: Purple background
- **Pizzas**: Red background
- **Salads**: Light green background

### Text Settings
- **Maximum Length**: 30 characters
- **Font Size**: 48px (TTF) or 5 (built-in)
- **Text Padding**: 20px from edges

## Output

The script will:

1. **Create backup directory** (`public/assets/front/img/product/backup/`)
2. **Generate new images** in the featured directory
3. **Update database** with new image names
4. **Create detailed logs** of all operations

## File Structure

```
King_Kebab/
├── simple_meal_image_downloader.php    # Main script
├── meal_image_config.php               # Configuration file
├── README_MEAL_IMAGES.md              # This documentation
├── public/
│   └── assets/
│       └── front/
│           └── img/
│               └── product/
│                   ├── featured/       # New images
│                   └── backup/         # Backup of old images
└── logs/                              # Log files
```

## Safety Features

- **Backup Creation**: All existing images are backed up before replacement
- **Error Handling**: Comprehensive error handling and logging
- **Database Safety**: Uses prepared statements to prevent SQL injection
- **File Permissions**: Checks and creates directories with proper permissions

## Troubleshooting

### Common Issues

1. **GD Extension Not Available**
   ```
   Error: GD extension is required for image processing.
   ```
   **Solution**: Enable GD extension in your PHP configuration

2. **Database Connection Failed**
   ```
   Database connection failed: Access denied for user
   ```
   **Solution**: Check database credentials in the config file

3. **Permission Denied**
   ```
   Failed to create directory
   ```
   **Solution**: Ensure write permissions to the project directory

4. **Memory Limit Exceeded**
   ```
   Fatal error: Allowed memory size exhausted
   ```
   **Solution**: Increase PHP memory limit or process meals in smaller batches

### Performance Tips

- **Batch Processing**: The script processes meals one by one to avoid memory issues
- **Image Optimization**: Images are automatically compressed and optimized
- **Logging**: Disable detailed logging for production use to improve performance

## Customization

### Adding New Categories

To add new meal categories with custom colors:

1. Edit `meal_image_config.php`
2. Add new color scheme:
   ```php
   'new_category' => [
       'background' => [R, G, B],
       'text' => [R, G, B],
       'accent' => [R, G, B],
       'border' => [R, G, B]
   ]
   ```
3. Add category mapping:
   ```php
   'category_mappings' => [
       'new_category_name' => 'new_category'
   ]
   ```

### Modifying Image Design

To change the visual design:

1. **Colors**: Modify the color schemes in the config
2. **Layout**: Edit the `addDecorativeElements()` method
3. **Text**: Adjust text positioning and styling
4. **Borders**: Modify border thickness and style

## Log Files

The script creates detailed logs in the specified log directory:

- **Log Level**: INFO, WARNING, ERROR
- **Log Format**: `[Timestamp] [Level] Message`
- **Log Rotation**: Automatic log rotation support

## Database Changes

The script updates the `products` table:

- **Field Updated**: `feature_image`
- **New Format**: `timestamp_meal_name.png`
- **Example**: `1703123456_chicken_burger.png`

## Security Considerations

- **Input Validation**: All meal names are sanitized before processing
- **SQL Injection**: Uses prepared statements for all database queries
- **File Upload**: Only generates images, no external file uploads
- **Permissions**: Minimal required permissions for image generation

## Support

If you encounter issues:

1. Check the log files for detailed error messages
2. Verify database credentials and permissions
3. Ensure all required PHP extensions are enabled
4. Check file permissions in the project directory

## License

This script is provided as-is for educational and commercial use. Modify as needed for your specific requirements.

## Version History

- **v1.0**: Initial release with basic image generation
- **v2.0**: Enhanced configuration and customization options
- **v2.1**: Added comprehensive error handling and logging
- **v2.2**: Improved category-based color schemes and Arabic support

---

**Note**: Always test the script on a development environment before running it on production. Backup your database and images before running the script. 