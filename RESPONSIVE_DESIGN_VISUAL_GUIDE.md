# Responsive Design Visual Guide

## Device Breakpoints

```
Mobile (< 640px)        Tablet (640px - 1024px)     Desktop (> 1024px)
┌─────────────────┐     ┌──────────────────────┐    ┌────────────────────────┐
│                 │     │                      │    │                        │
│   Single        │     │   2 Column           │    │    Multi-Column        │
│   Column        │     │   Layout             │    │    Responsive Grid     │
│   Layout        │     │                      │    │                        │
│                 │     │                      │    │                        │
└─────────────────┘     └──────────────────────┘    └────────────────────────┘
     sm: breakpoint           md: breakpoint          (no prefix)
```

## Component Responsive Behavior

### 1. Welcome Page - Button Row

```
Mobile (px-3, gap-2)           Tablet+ (px-5, gap-3)
┌──────────────────┐           ┌─────────────────────────────────┐
│ [Export] [Report]│           │ [Export Excel] [PDF Report] [+]  │
│ [+ Add] [Reset]  │           │ [+ Add Jadwal] [Reset & Delete]  │
└──────────────────┘           └─────────────────────────────────┘
```

### 2. Welcome Page - Card Grid

```
Mobile (w-full)            Tablet+ (w-full sm:min-w-[320px])
┌─────────────────┐       ┌─────────┬─────────┬──────────┐
│ Senin           │       │ Senin   │ Selasa  │ Rabu     │
│ ┌─────────────┐ │       │ ┌─────┐ │ ┌─────┐ │ ┌──────┐ │
│ │ Client 1    │ │       │ │C1  │ │ │C2  │ │ │C3    │ │
│ │ TAKE   ✓    │ │       │ └─────┘ │ └─────┘ │ └──────┘ │
│ │ ...         │ │       │ ┌─────┐ │ ┌─────┐ │          │
│ └─────────────┘ │       │ │C4  │ │ │C5  │ │          │
│ ┌─────────────┐ │       │ └─────┘ │ └─────┘ │          │
│ │ Client 2    │ │       └─────────┴─────────┴──────────┘
│ │ EDIT   ☑️    │ │    (Horizontal scroll on desktop,
│ │ ...         │ │     Stack on mobile)
│ └─────────────┘ │
└─────────────────┘
(Single column,
 full width)
```

### 3. Detail Modal - Form

```
Mobile (1 column)          Tablet+ (2 columns)
┌──────────────────┐      ┌────────────────┬────────────┐
│ Script Video     │      │ Link Referensi │ Link GDrive│
│ [...............]  │      │ [...........] │ [.........] │
│                  │      │                │             │
│ Caption & Hash   │      │ Caption & Hash │ (spans 2)   │
│ [...............]  │      │ [...........] │             │
│ [...............]  │      │ [...........] │             │
│                  │      │                │             │
│ Link Referensi   │      │  [Batal] [Simpan]           │
│ [............]   │      └────────────────┴────────────┘
│                  │
│ Link GDrive      │
│ [............]   │
│                  │
│ Caption & Hash   │
│ [............]   │
│                  │
│ [Batal] [Simpan] │
└──────────────────┘
```

### 4. PDF Report - Card Grid

```
Mobile (1 column)          Desktop (3 columns)
┌──────────────────┐      ┌─────────┬──────────┬──────────┐
│ ┌──────────────┐ │      │ ┌──────┐│ ┌──────┐ │ ┌──────┐ │
│ │ CLIENT 1 ✅  │ │      │ │C1 ✅ ││ │C2 ⁉️  │ │ │C3 ☑️  │ │
│ │              │ │      │ │      ││ │      │ │ │      │ │
│ │ 📌 Pilar...  │ │      │ │ Pilar││ │ Pilar│ │ │Pilar │ │
│ │ 📝 Script... │ │      │ │ ...  ││ │ ...  │ │ │ ...  │ │
│ │ #️⃣ Caption..  │ │      │ └──────┘│ └──────┘ │ └──────┘ │
│ │ 🔗 Links     │ │      │         │          │          │
│ └──────────────┘ │      │ ┌──────┐│ ┌──────┐ │          │
│                  │      │ │C4 ⏳  ││ │C5 ✔️  │ │          │
│ ┌──────────────┐ │      │ │      ││ │      │ │          │
│ │ CLIENT 2 ⁉️   │ │      │ └──────┘│ └──────┘ │          │
│ │ ...          │ │      └─────────┴──────────┴──────────┘
│ └──────────────┘ │   (Auto-fit, minmax(300px, 1fr))
│ (stacked,       │
│  full width)    │
└──────────────────┘
```

## Typography Scaling

```
Element              Mobile        Tablet        Desktop
═══════════════════════════════════════════════════════════
Heading (h1)         1.25rem       1.5rem        1.75rem
Heading (h2)         1.1rem        1.25rem       1.3rem
Body Text            0.875rem      0.95rem       0.95rem
Small Text           0.75rem       0.85rem       0.85rem
Input Labels         0.75rem       0.875rem      0.875rem
```

## Spacing Adjustments

```
Component              Mobile       Tablet+       Usage
════════════════════════════════════════════════════════════
Container Padding      p-3          p-4 / p-8     Page padding
Card Padding          p-3          p-4 / p-5     Content padding
Gap Between Items     gap-2        gap-3 / gap-4 Flexible spacing
Button Height         py-2         py-2.5        Touch target
Input Height          py-2         py-2          Form fields
Modal Height          max-h-[85vh] max-h-[90vh]  Viewport height
```

## Color Scheme (Unchanged)

```
Status Colors:
┌────────────┬──────────────────────┐
│ kosong ⏳  │ Gray (#F3F4F6)       │
│ take ✔️    │ Purple (#DDD6FE)     │
│ edit ☑️    │ Yellow (#FEF3C7)     │
│ acc ⁉️     │ Blue (#DBEAFE)       │
│ upload ✅  │ Green (#DCFCE7)      │
└────────────┴──────────────────────┘

Primary Colors:
Blue: #0066CC
White: #FFFFFF
Gray: #F9FAFB
Text: #1F2937
```

## Interactive Elements on Touch

All interactive elements have been optimized for touch:

```
Button Sizing (Mobile):
Min Height: 44px (10 iOS HIG recommendation)
Min Width: 44px
Padding: 0.5rem 0.75rem (minimum for touch)

Input Field Sizing:
Height: 2.5rem+ (comfortable for thumb input)
Padding: 0.5rem 0.75rem
Font Size: ≥16px (prevents zoom on iOS)

Select Dropdowns:
Height: 2.5rem
Padding: 0.5rem 0.75rem
Font Size: ≥14px
```

## Media Query Strategy

```css
/* Mobile First - Base Styles */
.container {
    padding: 1rem;
}
.button {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}

/* Tablet & Up */
@media (min-width: 640px) {
    /* sm: breakpoint */
    .container {
        padding: 1.5rem;
    }
    .button {
        padding: 0.625rem 1rem;
        font-size: 1rem;
    }
}

/* Desktop & Large Screens */
@media (min-width: 1024px) {
    /* lg: breakpoint */
    .container {
        padding: 2rem;
    }
}
```

## Grid Layout Examples

### Welcome.blade.php - Card Grid

```css
.cards-grid {
    display: flex;
    overflow-x: auto;
    gap: 1rem;
}

/* Mobile Override */
@media (max-width: 640px) {
    .cards-grid {
        flex-direction: column;
    }
    .card {
        width: 100%;
    }
}
```

### PDF Report - Cards Grid

```css
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}

/* Mobile Override */
@media (max-width: 768px) {
    .cards-grid {
        grid-template-columns: 1fr;
    }
}
```

## Testing Tips

### Browser DevTools Mobile View

1. Open DevTools (F12)
2. Click "Toggle device toolbar" (Ctrl+Shift+M)
3. Test at these widths:
    - 320px (iPhone SE)
    - 375px (iPhone 12)
    - 414px (iPhone XMax)
    - 768px (iPad)
    - 1024px (iPad Pro)
    - 1366px (Desktop)

### Real Device Testing Checklist

- [ ] Can reach all buttons with thumb on phone
- [ ] Text is readable without zoom
- [ ] Forms are easy to fill on mobile
- [ ] Modal doesn't cut off content
- [ ] Modal scrollable on small screens
- [ ] No horizontal scrolling except intentional
- [ ] Export buttons visible and clickable
- [ ] Status badges display correctly

### Performance Testing

- [ ] Page load time < 3s on 4G
- [ ] No layout shift (CLS < 0.1)
- [ ] No jank during scroll
- [ ] Modal transitions smooth

## Fallbacks & Browser Support

✅ **Supported:**

- Chrome/Edge 90+
- Safari 14+
- Firefox 88+
- Chrome for Android
- Safari on iOS 14+

⚠️ **Graceful Degradation:**

- CSS Grid falls back to block layout
- Flexbox well-supported across all browsers
- Media queries well-supported
- No JavaScript required for responsive behavior

🚫 **Not Supported (But Not Critical):**

- IE 11 and below
- Older Android browsers (< 5.0)
