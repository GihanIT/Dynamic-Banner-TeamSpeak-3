# 🖼️ TeamSpeak 3 Dynamic Banner Generator

A lightweight PHP script that generates a dynamic TeamSpeak 3 server banner image showing:

- 👥 Current number of connected clients (excluding query clients and bots)
- 🕒 Real-time server time (auto-updated per request)
- 📷 Photoshop PSD File Include

This banner can be used on websites, forums, or community hubs to visually represent your TeamSpeak server’s activity.

---

## 📷 Preview

assets/images/screenshot.jpg

---

## 🚀 Features

- Real-time client count from your TS3 server
- Current time display, auto-updating
- Custom font and background support
- Error fallback message if the server is unreachable
- Easy to deploy and extend

---

## 📦 Installation

1. **Clone the Repository**

```bash
git clone https://github.com/GihanIT/Dynamic-Banner-TeamSpeak-3.git
cd Dynamic Banner TeamSpeak 3
```

2. **Set up your server environment**

- PHP 7.0+ with GD extension enabled
- Web server (Apache, Nginx, etc.)
- Upload the project to your hosting/server

3. **Install the GD extension**

Ensure the GD extension is enabled for PHP to handle image processing. For example, on a Debian/Ubuntu-based system:

```bash
sudo apt-get update
sudo apt-get install php-gd
```

After installation, restart your web server (e.g., Apache or Nginx):

```bash
sudo service apache2 restart
# or
sudo service nginx restart
```

For other systems, refer to your PHP documentation for enabling the GD extension.

4. **Access the image**

```
http://yourdomain.com/banner.php
```

## ⚙️ Configuration

Open `banner.php` and configure the following:

```php
$ts3_server_address   = "your_teamspeak_server_address"; // e.g., ts3.example.com
$ts3_server_port      = 9987;                            // Default TS3 port
$ts3_query_username   = "serveradmin";                   // Query username
$ts3_query_password   = "your_password";                 // Query password
$ts3_server_port_query = 10011;                          // Query port
$ts3_bots = 0;                                           // Number of known bots to exclude
```

Check that your image and font files are correctly referenced:

```php
$banner = imagecreatefrompng("assets/images/Banner.png"); // Background image
$font   = 'assets/font/sourcesans.ttf';                   // TTF font file
```

---

## 📁 File Structure

```
.
├── assets/
│   ├── images/
│   │   └── Banner.png        # Background image for the banner
│   └── font/
│       └── sourcesans.ttf    # TrueType font used for text
├── vendor/
│   └── planetteamspeak/
│       └── ts3-php-framework # Installed TS3 PHP framework
├── banner.php                # Main PHP script
└── LICENSE                   # MIT License
```

---

## ⚠️ Notes

- Ensure your TeamSpeak 3 server allows query connections from your IP.
- Adjust `date_default_timezone_set()` in `banner.php` if you're in a different timezone:

```php
date_default_timezone_set('Asia/Colombo');
```

- Use caching or a cron job to reduce repeated queries if used on high-traffic pages.
- Ensure `assets/` folder permissions are set correctly for web access.
