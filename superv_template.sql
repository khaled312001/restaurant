-- Database template file
-- Replace sensitive API keys with your actual values in production
-- DO NOT commit this file with real API keys

-- Payment methods table with placeholder values
INSERT INTO `pos_payment_methods` (`id`, `language_id`, `name`, `description`, `status`, `serial_number`, `text`, `method`, `is_default`) VALUES
(9, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"YOUR_RAZORPAY_KEY\",\"secret\":\"YOUR_RAZORPAY_SECRET\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', 0),
(11, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"YOUR_PAYTM_MERCHANT\",\"secret\":\"YOUR_PAYTM_SECRET\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"text\":\"Pay via your paytm account.\"}', 'paytm', 0),
(12, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"YOUR_PAYSTACK_KEY\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', 0),
(13, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"YOUR_INSTAMOJO_KEY\",\"token\":\"YOUR_INSTAMOJO_TOKEN\",\"sandbox_check\":\"0\",\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', 0),
(14, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"YOUR_STRIPE_PUBLISHABLE_KEY\",\"secret\":\"YOUR_STRIPE_SECRET_KEY\",\"text\":\"Pay via your Credit account.\"}', 'Stripe', 1),
(15, NULL, NULL, NULL, 'Paypal', 'automatic', '{\"client_id\":\"YOUR_PAYPAL_CLIENT_ID\",\"client_secret\":\"YOUR_PAYPAL_CLIENT_SECRET\",\"sandbox_check\":\"0\",\"text\":\"Pay via your PayPal account.\"}', 'paypal', 0),
(17, NULL, NULL, NULL, 'Mollie Payment', 'automatic', '{\"key\":\"YOUR_MOLLIE_KEY\",\"text\":\"Pay via your Mollie Payment account.\"}', 'mollie', 0),
(18, NULL, NULL, NULL, 'PayUmoney', 'automatic', '{\"key\":\"YOUR_PAYUMONEY_KEY\",\"salt\":\"YOUR_PAYUMONEY_SALT\",\"text\":\"Pay via your PayUmoney account.\"}', 'payumoney', 1),
(19, NULL, NULL, NULL, 'Mercado Pago', 'automatic', '{\"token\":\"YOUR_MERCADOPAGO_TOKEN\",\"sandbox_check\":\"0\",\"text\":\"Pay via your Mercado Pago account.\"}', 'mercadopago', 0);

-- Add other table structures and sample data as needed
-- This is just a template - replace placeholder values with actual API keys in production 