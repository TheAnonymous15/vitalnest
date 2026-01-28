# Vitalnest Gateway - Public Portal

## Directory Structure

```
gateway/public/
├── index.php                 # Main router - includes all components
├── includes/
│   ├── components/          # Reusable UI components
│   │   ├── header.php      # HTML head, styles, scripts
│   │   ├── navbar.php      # Navigation bar
│   │   └── footer.php      # Footer and closing scripts
│   └── sections/           # Page content sections
│       ├── hero.php        # Hero section
│       ├── services.php    # Services section (to be created)
│       ├── packages.php    # Care packages section (to be created)
│       ├── how-it-works.php # How it works section (to be created)
│       └── testimonials.php # Testimonials section (to be created)
```

## Architecture

### Router Pattern
The `index.php` acts as the main router that:
1. Starts the session
2. Checks user authentication
3. Sets page metadata
4. Includes components in the correct order

### Component Structure

#### Components (`includes/components/`)
- **header.php**: Contains `<head>` section with all CSS, scripts, and Tailwind config
- **navbar.php**: Responsive navigation bar with user authentication states
- **footer.php**: Site footer with links, scripts, and closing HTML tags

#### Sections (`includes/sections/`)
- **hero.php**: Landing page hero section with CTA
- Additional sections to be created as separate files

## Adding New Sections

To add a new section:

1. Create a new file in `includes/sections/`, e.g., `services.php`
2. Add the section content (just the HTML, no head/body tags)
3. Include it in `index.php`:
   ```php
   require_once SECTIONS_PATH . '/services.php';
   ```

## Benefits

✅ **Modular** - Each component is separate and reusable
✅ **Maintainable** - Easy to update individual sections
✅ **Scalable** - Can easily add new pages/sections
✅ **DRY** - Don't Repeat Yourself - components used across pages
✅ **Clean** - Router file is simple and easy to understand

## Session Variables

- `$isLoggedIn` - Boolean, true if user is authenticated
- `$userRole` - String, user's role (guest, patient, clinician, admin, etc.)
- `$userName` - String, user's display name

## Next Steps

Create additional section files:
- [ ] services.php
- [ ] packages.php
- [ ] how-it-works.php
- [ ] testimonials.php
- [ ] cta.php

