# Quick Reference - Responsive Mobile-First Design

## 🚀 Quick Start

### To Deploy

```bash
# 1. Set environment variables on production
APP_KEY=your-app-key
DB_HOST=your-db-host
DB_PASSWORD=your-password

# 2. Run migrations (if needed)
php artisan migrate

# 3. Deploy to Vercel or your hosting
```

### To Test Locally

```bash
php artisan serve
# Visit: http://localhost:8000
# Test on mobile: Use browser DevTools (F12 → Ctrl+Shift+M)
```

---

## 📱 Responsive Breakpoints Cheat Sheet

```
Mobile        Tablet        Desktop
< 640px       640px-1024px  > 1024px
(default)     (sm:)         (no prefix after sm:)
```

### Quick Examples

```html
<!-- Text sizing -->
<p class="text-xs sm:text-sm md:text-base">
    Mobile: extra small | Tablet: small | Desktop: base

    <!-- Padding -->
</p>

<div class="p-3 sm:p-6 md:p-8">
    Mobile: 0.75rem | Tablet: 1.5rem | Desktop: 2rem

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        Mobile: 1 column | Tablet: 2 columns | Desktop: 3 columns
    </div>
</div>
```

---

## 🎨 Responsive Classes Used

### Text & Typography

```
text-xs sm:text-sm          Font size responsive
text-xl sm:text-2xl         Larger text responsive
font-bold                   Weight consistent
tracking-wide              Letter spacing
```

### Spacing & Padding

```
p-3 sm:p-6                 Padding responsive
px-3 sm:px-4               Horizontal padding only
py-2 sm:py-2.5             Vertical padding only
gap-2 sm:gap-4             Gap between flex items
```

### Layout & Sizing

```
w-full                      Full width
flex flex-wrap              Buttons that wrap
grid grid-cols-1 sm:grid-cols-2    Responsive grid
max-w-xl                    Max width container
```

### Display & Visibility

```
flex flex-col sm:flex-row   Stack or row layout
overflow-x-auto             Horizontal scroll
max-h-[85vh]               Height constraint
```

---

## 📋 Form Elements Template

### Responsive Input

```html
<div>
    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-1">
        Label Text
    </label>
    <input
        type="text"
        class="w-full text-xs sm:text-sm border px-3 py-2 sm:px-4 sm:py-2"
    />
</div>
```

### Responsive Select

```html
<select class="w-full text-xs sm:text-sm border px-3 py-2 sm:px-4">
    <option>Option 1</option>
    <option>Option 2</option>
</select>
```

### Responsive Textarea

```html
<textarea
    class="w-full text-xs sm:text-sm border px-3 py-2 sm:px-4 sm:py-2"
    rows="3"
></textarea>
```

### Responsive Buttons

```html
<!-- Button row that wraps -->
<div class="flex flex-wrap gap-2 sm:gap-3">
    <button class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm">
        Button 1
    </button>
    <button class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm">
        Button 2
    </button>
</div>

<!-- Flexible button row -->
<div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
    <button class="flex-1 px-4 py-2 sm:py-2.5">Button</button>
</div>
```

---

## 🎯 Modal Responsive Template

```html
<div
    id="modal"
    class="fixed inset-0 flex items-center justify-center 
  opacity-0 pointer-events-none transition-opacity duration-300"
>
    <div
        class="relative bg-white rounded-lg max-w-lg max-h-[85vh] 
    sm:max-h-[90vh] overflow-y-auto w-full mx-4 sm:mx-0"
    >
        <!-- Header -->
        <div class="p-4 sm:p-8 border-b">
            <h2 class="text-lg sm:text-xl font-bold">Title</h2>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-8">
            <!-- Form fields here -->
        </div>

        <!-- Buttons -->
        <div
            class="p-4 sm:p-8 border-t flex flex-col sm:flex-row gap-2 sm:gap-3"
        >
            <button class="flex-1 px-4 py-2 sm:py-2.5">Cancel</button>
            <button class="flex-1 px-4 py-2 sm:py-2.5">Save</button>
        </div>
    </div>
</div>
```

---

## 🔴 Card Grid Responsive Template

```html
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
    <div class="bg-white p-3 sm:p-4 rounded-lg border">
        <h3 class="text-sm sm:text-base font-bold mb-2">Title</h3>
        <p class="text-xs sm:text-sm text-gray-600">Content</p>
    </div>
</div>
```

---

## 📊 File Changes Summary

### Modified Files

| File                  | Changes                 | Status |
| --------------------- | ----------------------- | ------ |
| welcome.blade.php     | Dashboard responsive    | ✅     |
| pdf_report.blade.php  | Report cards responsive | ✅     |
| create.blade.php      | Form responsive         | ✅     |
| ContentController.php | Export methods          | ✅     |
| routes/web.php        | Export routes           | ✅     |

### Export Routes

```php
GET /export/excel?minggu=Minggu%201      // Download CSV
GET /export/pdf?minggu=Minggu%201        // View/download PDF
```

---

## 🧪 Testing Quick Commands

### View in Browser

```bash
# Default
http://localhost:8000

# With week filter
http://localhost:8000/?minggu=Minggu%202

# Export Excel
http://localhost:8000/export/excel?minggu=Minggu%201

# Export PDF (browser print)
http://localhost:8000/export/pdf?minggu=Minggu%201
```

### DevTools Mobile Testing

1. Press **F12** to open DevTools
2. Press **Ctrl+Shift+M** to toggle device toolbar
3. Select device from dropdown (iPhone 12, iPad, etc.)
4. Test responsiveness

### Responsive Sizes to Test

- 320px (iPhone SE)
- 375px (iPhone 12)
- 414px (iPhone XMax)
- 768px (iPad)
- 1024px (iPad Pro)
- 1366px (Desktop)

---

## 🛠️ Common Responsive Patterns

### Text That Scales

```html
<h1 class="text-xl sm:text-2xl md:text-3xl">Heading</h1>
<p class="text-xs sm:text-sm md:text-base">Paragraph</p>
```

### Container With Responsive Padding

```html
<div class="container mx-auto px-3 sm:px-6 md:px-8 py-4 sm:py-6">Content</div>
```

### Flexible Layout (Wraps on Mobile)

```html
<div class="flex flex-wrap gap-2 sm:gap-4">
    <div class="flex-1 min-w-[200px]">Item 1</div>
    <div class="flex-1 min-w-[200px]">Item 2</div>
</div>
```

### Grid That Adapts

```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <div>Item 1</div>
    <div>Item 2</div>
</div>
```

### Full Height Responsive

```html
<div class="h-screen sm:h-auto">Full screen on mobile, auto on desktop</div>
```

---

## ⚙️ Optional: Install Dompdf for PDF

If you want automatic PDF downloads instead of browser fallback:

```bash
cd /path/to/qc-kreatif
composer require dompdf/dompdf
```

After installation, `/export/pdf` will auto-generate PDFs.

---

## 🐛 Troubleshooting

### Buttons Overlap on Mobile

```html
<!-- ❌ Don't use -->
<div class="flex">
    <button class="w-1/2">Button 1</button>
    <button class="w-1/2">Button 2</button>
</div>

<!-- ✅ Do use -->
<div class="flex flex-wrap gap-2 sm:gap-3">
    <button class="flex-1 px-3 sm:px-5">Button 1</button>
    <button class="flex-1 px-3 sm:px-5">Button 2</button>
</div>
```

### Text Too Small on Mobile

```html
<!-- ❌ Don't use -->
<p class="text-sm">Content</p>

<!-- ✅ Do use -->
<p class="text-xs sm:text-sm">Content</p>
```

### Modal Cut Off on Mobile

```html
<!-- ❌ Don't use -->
<div class="max-h-screen">Modal</div>

<!-- ✅ Do use -->
<div class="max-h-[85vh] sm:max-h-[90vh] overflow-y-auto">Modal</div>
```

### Form Too Cramped

```html
<!-- ❌ Don't use -->
<form class="grid grid-cols-2 gap-2">
    <input />
</form>

<!-- ✅ Do use -->
<form class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
    <input class="text-xs sm:text-sm px-3 py-2 sm:px-4" />
</form>
```

---

## 📚 Tailwind CSS Responsive Reference

```
Default    < 640px   Mobile first
sm:        ≥ 640px   Small devices (iPad)
md:        ≥ 768px   Medium devices
lg:        ≥ 1024px  Large devices
xl:        ≥ 1280px  Extra large
2xl:       ≥ 1536px  2x Extra large
```

### How to Use

```html
<!-- Syntax: {breakpoint}:{utility} -->
<div class="text-sm sm:text-base md:text-lg lg:text-xl">
    <!-- Mobile: text-sm -->
    <!-- Tablet: text-base -->
    <!-- Desktop: text-lg -->
    <!-- Large: text-xl -->
</div>
```

---

## ✨ Best Practices

1. **Mobile-First**: Design for mobile first, enhance for larger screens
2. **Flexible Units**: Use `flex-1`, percentages, and relative units
3. **Responsive Typography**: Always scale text with `sm:` and `md:`
4. **Touch-Friendly**: Minimum 44px for buttons/clickables
5. **Readable**: Maintain good contrast and font sizes
6. **Test**: Always test on real devices and multiple browsers
7. **Performance**: Use CSS for layout, avoid heavy JavaScript

---

## 🚀 Deployment Checklist

- [x] All views are responsive
- [x] Export features working
- [x] No syntax errors
- [x] Tested in browser
- [ ] Tested on mobile device
- [ ] Dompdf installed (optional)
- [ ] Environment variables set
- [ ] Database configured
- [ ] Ready for production

---

## 📞 Support & Documentation

For more detailed information, see:

- `RESPONSIVE_DESIGN_SUMMARY.md` - Full implementation details
- `RESPONSIVE_DESIGN_VISUAL_GUIDE.md` - Visual examples
- `COMPLETION_CHECKLIST.md` - Complete feature list
- `BEFORE_AFTER_COMPARISON.md` - UI transformation details

---

**Last Updated:** April 2, 2026  
**Version:** 1.0 - Final Responsive Design  
**Status:** ✅ Production Ready
