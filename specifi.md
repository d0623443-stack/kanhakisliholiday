# Kanha Kisli Holiday — Frontend Implementation Specification

## 1. Project Goal

Build a production-quality **CodeIgniter 4 + Tailwind CSS** frontend for **Kanha Kisli Holiday**, a wildlife and hospitality website focused on Kanha National Park.

CodeIgniter 4 is already installed. Do **not** recreate or replace the CI4 project.

The supplied homepage reference is the visual direction, not a pixel-for-pixel restriction. Improve it where needed. The finished website should feel:

- premium, calm, natural, editorial, and immersive
- wildlife-first rather than hotel/resort-first
- spacious without looking empty
- consistent from section to section
- responsive and accessible
- fast on mobile and optimized for real production use

Avoid the common “template” look: excessive cards, repeated alternating dark/light bands, oversized empty gaps, random gradients, glassmorphism, excessive rounded boxes, and decorative elements with no purpose.

---

## 2. Technology

### Required
- CodeIgniter 4
- PHP views
- Tailwind CSS
- Vanilla JavaScript for small interactions
- Reusable CI4 partials/components
- Semantic HTML5

### Avoid unless already present
- Bootstrap
- jQuery
- React/Vue
- large slider libraries
- icon libraries loaded only for 2–3 icons

If a carousel is required, prefer a small dependency such as Swiper only when it provides a real UX benefit. Otherwise implement a lightweight accessible slider.

---

## 3. Website Structure

Main navigation:

1. Home
2. Safari
3. Accommodation
4. Gallery
5. Contact

Important product rule:

**Accommodation is one general accommodation page. There are no separate hotel pages and no room-category pages.**

It can showcase rooms/stays through imagery and descriptive content, but do not invent Standard / Deluxe / Luxury room category structures.

Safari is specifically focused on **Kanha safari**.

---

# 4. Design Direction

## Brand Character

Use the visual language of Kanha forest:

- dense sal forest
- warm sunlight
- safari trails
- wildlife photography
- understated hospitality
- handcrafted/editorial details

The site should feel closer to a premium nature journal or boutique wildlife lodge publication than a generic travel booking portal.

## Visual hierarchy

Use three layers:

1. **Immersive photography** for high-impact moments
2. **Warm neutral editorial canvas** for readable content
3. **Deep forest green** for navigation, actions, footer, and selected emphasis

Do not continuously alternate full-width dark and light sections. Most of the homepage should live on one coherent warm neutral background, with contrast introduced through imagery, typography, spacing, borders, and small green accents.

---

# 5. Design Tokens

Use Tailwind theme variables/classes consistently rather than arbitrary colors everywhere.

## Colors

```text
Forest 950    #132A21
Forest 900    #18382B
Forest 800    #214B38
Forest 700    #2D6248
Forest 600    #3C7657

Moss          #6E8065
Sage          #AEBCA4
Sage Light    #DDE5D8

Ivory         #F7F4EC
Warm White    #FBFAF6
Sand          #EAE2D4
Stone         #CBC4B8

Ink           #18201C
Body          #555D58
Muted         #7C827E

Warm Gold     #B89458
```

### Usage
- Main page background: `#FBFAF6`
- Alternate subtle background: `#F7F4EC`
- Primary CTA: Forest 800/900
- Main text: Ink
- Body copy: Body
- Borders: Stone at low opacity
- Gold only as a restrained highlight

Do not use bright emerald green.

## Typography

Use a strong editorial serif for headings and a clean sans-serif for UI/body text.

Recommended:
- Heading: **Cormorant Garamond**, **DM Serif Display**, or **Libre Baskerville**
- Body/UI: **Inter** or **Manrope**

Load at most two font families and only required weights.

Suggested scale:

```text
Hero H1:
mobile  3rem / .95
tablet  4.5rem / .95
desktop clamp(4.5rem, 6.5vw, 7rem)

Section H2:
mobile  2.25rem
desktop 3.5rem–4.5rem

Body:
16–18px
line-height 1.6–1.75

Eyebrow:
11–12px
uppercase
letter-spacing .18em–.24em
font-weight 600
```

Headings should have tight line-height and controlled widths. Do not center every heading.

---

# 6. Layout System

Use a consistent container:

```text
max-width: 1280–1360px
desktop horizontal padding: 48–64px
tablet: 32px
mobile: 20px
```

Preferred section spacing:

```text
desktop: 112–144px
tablet: 88–104px
mobile: 64–80px
```

Do not create giant empty gaps.

Use a 12-column desktop grid where useful.

Section content should intentionally alternate alignment and composition, but the visual language must remain consistent.

---

# 7. Header

The homepage header sits **over the hero image** and is transparent initially.

## Desktop arrangement

The logo must be visually centered in the viewport.

```text
Home | Safari        [ circular logo ]        Accommodation | Gallery | Contact
```

Do not merely center the logo between two unequal flex groups. Position it so it remains geometrically centered.

### Header behavior
- transparent over hero
- white/ivory navigation text
- subtle active-page underline
- approximately 84–96px tall
- no large solid navbar block over the hero
- on scroll, optionally transition to a compact warm-white or dark-forest header with readable text
- preserve layout stability

### Logo
Use a circular placeholder until the actual logo exists:
- 58–68px desktop
- ivory/white background
- thin forest border
- `LOGO` placeholder centered

### Mobile
- logo left or centered
- hamburger right
- accessible slide-down/off-canvas navigation
- close button
- focus management
- `aria-expanded`

---

# 8. Homepage

## Section 1 — Hero

The hero is the strongest visual moment.

### Height
- desktop: `min-height: 760px`, preferably `90–100svh`
- mobile: `min-height: 680px`

Use a **full-bleed wildlife/safari slider image**.

Preferred imagery:
- safari jeep on forest trail
- filtered golden morning light
- enough dark negative space on the left for text
- natural, cinematic photography

### Overlay
Do not apply a flat black overlay to the whole image.

Use a controlled gradient:
- stronger dark overlay from left
- light central fade
- subtle bottom gradient for controls

The photograph must remain vivid.

### Hero copy

Eyebrow:

`KANHA · MADHYA PRADESH`

Heading:

`Discover the wild.`  
`Feel closer to nature.`

Supporting text:

`Memorable safaris and peaceful stays in the heart of Kanha.`

CTAs:
- Primary: `Explore Safari`
- Secondary: `Plan your visit`

### Hero controls
- previous/next circular arrows near side edges
- slide counter `01 / 03`
- minimal progress bars
- controls must be keyboard accessible
- no autoplay unless it pauses for user interaction and respects reduced-motion preferences

The copy block should sit lower than the header and approximately within the left 45% of the hero.

---

## Section 2 — About

Eyebrow:

`ABOUT KANHA KISLI HOLIDAY`

Heading:

`Where the forest sets the pace.`

Copy should communicate slow travel, safari assistance, personal attention, and connection to Kanha.

### Important improvement
Do not use a rigid 50/50 “text left + rectangular image right” corporate layout.

Use an editorial composition:
- text occupies roughly 42%
- imagery occupies roughly 50%
- primary image slightly taller
- secondary wildlife image overlaps it like a restrained photographic print
- optional botanical line illustration can sit behind the photographs at very low contrast

Keep decorative art subtle.

Feature highlights:
- Safari assistance
- Personal attention

Use simple line icons, not big icon cards.

Text link:
`Get to know us →`

---

## Section 3 — Safari Story / Experience

Eyebrow:

`SAFARI EXPERIENCES`

Heading:

`Into the heart of Kanha.`

This section should become more sophisticated than the reference.

### Desktop composition
Left:
- large vertical wildlife photograph
- use an **arched top frame** or organic editorial mask
- image width about 40–44%
- botanical line work may partly overlap outside the frame

Right:
a vertical journey with three numbered items:

`01 — Follow the forest trails`  
Discover the beauty of Kanha with a guided safari.

`02 — Look a little closer`  
From birds to deer, every sighting tells a story.

`03 — Make it your journey`  
Talk to us about your safari plans.

Connect numbers with a fine vertical dotted/solid line.

CTA:
`Discover Safari →`

Do not put each step inside a card.

### Mobile
Image first, then steps. Remove unnecessary decorative elements rather than squeezing them.

---

## Section 4 — Accommodation Preview

The reference under-emphasizes accommodation. Add a refined homepage preview because Accommodation is a primary navigation item.

Eyebrow:

`STAY CLOSE TO THE WILD`

Heading:

`Rest between the adventures.`

Copy:
A short paragraph about comfortable, peaceful accommodation around the Kanha experience.

### Layout
Use one large landscape accommodation image and 1–2 supporting detail images.

Do not create room-category cards.

Use descriptive labels such as:
- Peaceful stays
- Thoughtful comfort
- Close to Kanha

CTA:
`Explore Accommodation →`

This section should feel hospitality-oriented without making the website look like a hotel booking marketplace.

---

## Section 5 — Gallery

Eyebrow:

`GALLERY`

Heading:

`A glimpse of Kanha.`

Subcopy:
`Moments from the forest.`

Use an editorial image grid rather than three identical cards.

Suggested desktop grid:
- large image occupying ~50%
- two smaller images stacked or arranged beside it
- optional fourth landscape crop

Subjects:
- tiger/wildlife
- safari jeep/forest trail
- deer
- birdlife

On hover:
- extremely subtle image scale (`1.02–1.04`)
- label reveal or slight contrast shift
- no heavy overlays

CTA:
`View Gallery →`

Mobile: horizontal snap gallery or clean stacked grid.

---

## Section 6 — Guest Stories

Eyebrow:

`GUEST STORIES`

Heading:

`Stories from the forest.`

Show 2–3 testimonials.

Do not use oversized testimonial cards. Use:
- thin border
- generous but controlled padding
- large opening quote mark
- short quote
- guest name/location only if real data exists

Do not invent customer names.

---

## Section 7 — Final CTA

Use a wide contained banner just before the footer.

Heading:

`Your Kanha story starts here.`

Text:

`Let's plan a little time in the wild.`

CTA:

`Enquire Now →`

Style:
- warm ivory background
- fine border
- forest silhouettes/botanical line art at low opacity
- forest-green pill/button
- avoid a loud gradient

---

# 9. Footer

The footer needs to feel intentional and premium.

Background: deep forest green.

Desktop: 3–4-column layout.

### Brand column
- logo/mark
- `KANHA KISLI HOLIDAY`
- `Thoughtful stays. Memorable safaris.`
- social links if configured

### Explore
- Home
- Safari
- Accommodation
- Gallery
- Contact

### Get in touch
- Kanha, Madhya Pradesh
- phone
- email
- enquiry link

### Bottom bar
- copyright
- Privacy Policy

Use fine translucent separators. Avoid stuffing.

On mobile, stack logically with generous spacing.

---

# 10. Safari Page

This page is specifically for Kanha safari.

Recommended flow:

1. Compact inner-page hero
2. Intro to Kanha safari
3. Safari experience / zones information
4. What guests can expect
5. Safari planning guidance
6. Wildlife visual strip/gallery
7. Important notes
8. Enquiry CTA

Do not make unsupported claims about wildlife sightings or guaranteed tiger sightings.

The page should support future dynamic content from CI4.

---

# 11. Accommodation Page

There is **one accommodation page**.

Do not create:
- individual hotel detail routes
- room category routes
- fake Standard/Deluxe/Luxury packages

Page flow:

1. Hero
2. Intro
3. Large accommodation image slider/gallery
4. Comfort/facilities overview
5. Stay experience
6. Enquiry form
7. Contact CTA

The gallery can show multiple room/interior/exterior images without assigning room categories.

---

# 12. Gallery Page

Use responsive masonry/editorial grid.

Suggested filters only if real categories/data exist:
- Wildlife
- Safari
- Forest
- Stay

If no category data exists, do not render fake filters.

Click opens an accessible lightbox:
- previous/next
- close
- keyboard support
- Escape closes
- meaningful alt text

Use thumbnails and lazy loading.

---

# 13. Contact Page

Keep the page simple.

Include:
- phone
- email
- address
- enquiry form
- optional map only if real location/embed data is configured

Form fields:
- Name
- Phone
- Email
- Interested in
- Preferred travel date
- Message

Use server-side CI4 validation.

Do not rely only on JavaScript validation.

---

# 14. CI4 View Architecture

Recommended structure:

```text
app/
└── Views/
    ├── layouts/
    │   └── main.php
    │
    ├── partials/
    │   ├── header.php
    │   ├── footer.php
    │   ├── mobile-menu.php
    │   └── enquiry-cta.php
    │
    ├── components/
    │   ├── section-heading.php
    │   ├── button.php
    │   ├── picture.php
    │   └── testimonial.php
    │
    └── pages/
        ├── home.php
        ├── safari.php
        ├── accommodation.php
        ├── gallery.php
        └── contact.php

public/
├── assets/
│   ├── images/
│   │   ├── home/
│   │   ├── safari/
│   │   ├── accommodation/
│   │   └── gallery/
│   └── icons/
└── build/ or css/
```

Use the CI4 layout system:

```php
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
...
<?= $this->endSection() ?>
```

Use partials for genuinely repeated UI, not every tiny HTML fragment.

---

# 15. Routes

Suggested public routes:

```php
$routes->get('/', 'Home::index');
$routes->get('safari', 'Safari::index');
$routes->get('accommodation', 'Accommodation::index');
$routes->get('gallery', 'Gallery::index');
$routes->get('contact', 'Contact::index');

$routes->post('contact/enquiry', 'Contact::enquiry');
```

Use named routes where useful.

Do not add `/public` to URLs.

---

# 16. Tailwind Architecture

Keep custom CSS small.

Use Tailwind for:
- layout
- spacing
- typography
- responsive states
- interaction states

Use custom CSS only for:
- font-face declarations if locally hosted
- complex image masks
- decorative botanical positioning
- slider mechanics not cleanly expressible in utilities

Create reusable component classes sparingly via `@layer components`.

Do not build a second design system in a huge custom CSS file.

---

# 17. Responsive Requirements

Design mobile-first.

Test at minimum:

```text
320px
375px
430px
768px
1024px
1280px
1440px+
```

Rules:
- no horizontal overflow
- hero text must remain readable
- buttons can wrap but must not become tiny
- images should preserve meaningful focal points
- navigation becomes mobile menu
- decorative illustrations can disappear on small screens
- typography uses `clamp()` where appropriate
- avoid fixed pixel heights for content sections

---

# 18. Image Handling

Use:
- WebP/AVIF when available
- explicit `width` and `height`
- `loading="lazy"` below the fold
- `decoding="async"`
- responsive `srcset` where practical
- `object-cover`
- carefully selected `object-position`

Do not lazy-load the primary hero/LCP image.

Preload the initial hero image only when appropriate.

Avoid loading all hero slides at maximum resolution immediately.

---

# 19. Accessibility

Target WCAG 2.2 AA fundamentals.

Required:
- visible keyboard focus
- logical heading order
- semantic landmarks
- skip-to-content link
- alt text for meaningful imagery
- decorative illustrations use empty alt / appropriate semantics
- minimum 44×44px touch targets where practical
- sufficient contrast
- menu and slider keyboard support
- form labels always visible
- error messages connected to fields
- respect `prefers-reduced-motion`

Do not remove focus outlines without a replacement.

---

# 20. Performance

Aim for:
- minimal JavaScript
- no unnecessary UI frameworks
- optimized hero media
- lazy-loaded gallery images
- locally bundled Tailwind production CSS
- no CDN Tailwind in production
- no layout shifts caused by images/fonts
- reusable image sizes
- defer non-critical JS

Target good Core Web Vitals, especially LCP and CLS.

---

# 21. SEO / Metadata

Each page needs:
- unique `<title>`
- meta description
- canonical URL
- Open Graph basics
- meaningful H1
- clean URL
- correct image alt text

Add Organization/LocalBusiness structured data only when real business data is available.

Do not fabricate reviews, ratings, address details, or business claims for schema.

---

# 22. Content Rules

Do not invent:
- room categories
- resort names
- package prices
- safari prices
- guest names
- ratings
- wildlife guarantees
- phone/email/address values

Use clear placeholders or configuration variables when data has not been provided.

Keep homepage copy concise. The photography and hierarchy should carry the experience.

---

# 23. Implementation Sequence

Implement in this order:

1. Inspect the existing CI4 project and Tailwind setup.
2. Do not overwrite working configuration unnecessarily.
3. Establish design tokens and global typography.
4. Build `layouts/main.php`.
5. Build transparent/sticky header and responsive navigation.
6. Build footer.
7. Implement homepage hero.
8. Implement homepage editorial sections.
9. Implement Safari page.
10. Implement Accommodation page.
11. Implement Gallery page/lightbox.
12. Implement Contact page and CI4 validation.
13. Optimize responsive images and loading.
14. Perform accessibility pass.
15. Perform responsive visual QA.
16. Run production Tailwind build and CI4 tests/checks.

---

# 24. Homepage Acceptance Criteria

The homepage is complete only when:

- logo is geometrically centered on desktop
- menu items appear on both sides of the logo
- header is transparent over the hero
- hero uses a large full-width safari image/slider
- text remains readable without destroying image quality
- design does not feel overstuffed
- sections share one coherent visual language
- About section feels editorial rather than corporate
- Safari section has a distinctive visual composition
- Accommodation gets a meaningful preview without room categories
- Gallery is more dynamic than three identical cards
- testimonials remain restrained
- final CTA transitions naturally into footer
- footer is visually refined
- mobile layout works from 320px
- keyboard navigation is usable
- reduced motion is respected
- there is no horizontal overflow
- there are no broken image aspect ratios
- there are no invented business facts
- production assets are optimized

---

# 25. Visual QA Checklist

Before considering a page finished, compare it against these questions:

### Composition
- Is there one obvious focal point per section?
- Does the eye naturally move from heading → copy → action → image?
- Are image sizes intentionally varied?
- Is whitespace useful rather than excessive?

### Consistency
- Are all buttons from the same family?
- Are eyebrow labels consistent?
- Are heading sizes systematic?
- Are section paddings consistent?
- Are greens and neutrals drawn from the token palette?

### Restraint
- Can any border, icon, leaf illustration, shadow, or card be removed without losing meaning?
- Are decorative leaves supporting composition rather than filling empty space?
- Are there too many rounded rectangles?

### Mobile
- Does the hero still feel immersive?
- Are important subjects cropped correctly?
- Are headings wrapping naturally?
- Is every CTA easy to tap?
- Does content order still make sense without desktop positioning?

---

# 26. Final Design Principle

**Nature is the visual hero; the interface should frame it, not compete with it.**

The final website should look custom-designed for Kanha Kisli Holiday, not like a generic Tailwind travel template.
