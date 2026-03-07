# 🚀 Quick Start Guide - Hydroponic Dashboard (Laravel)

## 1️⃣ Setup Instructions

### Prerequisites
```bash
- PHP 8.3+
- Laravel 11
- Composer
- Node.js & npm/pnpm
```

### Installation
```bash
cd Learn1

# Install dependencies
composer install
pnpm install

# Build assets
pnpm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations (ketika database sudah siap)
php artisan migrate
```

---

## 2️⃣ Running the Application

### Start Development Server
```bash
# Terminal 1: Start Laravel
php artisan serve

# Terminal 2 (optional): Build assets in watch mode
pnpm run dev
```

### Access Dashboard
```
URL: http://localhost:8000/hydroponic
```

---

## 3️⃣ Available Routes

```
GET  /hydroponic                    Dashboard utama
POST /hydroponic/pump/start         Nyalakan pompa
POST /hydroponic/pump/stop          Matikan pompa
POST /hydroponic/nutrient/trigger   Trigger nutrient dosing
POST /hydroponic/ph/adjust          Adjust pH level
GET  /hydroponic/report/download    Download report PDF
GET  /hydroponic/docs               Dokumentasi
GET  /hydroponic/support            Support page
```

---

## 4️⃣ Features Overview

### 📊 Real-Time Monitoring
- **PPM Sensor** - Parts Per Million (nutrient level)
- **pH Sensor** - pH level with optimal range indicator
- **Water Level** - Current water percentage

### 📈 Data Visualization
- **Live 24-Hour Charts** - pH and PPM trends
- **Weekly Analytics** - Average values and usage statistics
- **Activity Log** - Historical system events

### ⚙️ System Controls
- **Water Pump Control** - Start/Stop
- **Nutrient Doser** - 10ml, 20ml, 30ml doses
- **pH Adjustment** - pH Down 5ml, 10ml

### 🌱 Recommendations
- Auto-generated plant health suggestions
- pH range warnings
- Nutrient level alerts

---

## 5️⃣ Sample Data Structure

### Current Sensor Reading
```php
[
    'ppm' => 850,              // Parts per million
    'ppmStatus' => 'Normal',   // Normal, Low, High
    'ph' => 6.2,               // pH level
    'waterLevel' => 65,        // Percentage
]
```

### 24-Hour Chart Data
```php
[
    ['time' => '00:00', 'ph' => 6.1, 'ppm' => 840],
    ['time' => '02:00', 'ph' => 6.0, 'ppm' => 835],
    // ... more data points
    ['time' => '22:00', 'ph' => 6.2, 'ppm' => 850],
]
```

### Weekly Statistics
```php
[
    'avgPh' => 6.18,
    'avgPpm' => 847,
    'waterUsage' => 42,      // Liters
    'nutrientUsage' => 150,  // ml
]
```

---

## 6️⃣ Controller Methods

Located in: `app/Http/Controllers/HydroponicController.php`

### Main Dashboard
```php
public function index()
{
    // Return dashboard with real-time data
}
```

### Pump Control
```php
public function startPump(Request $request)  // POST
public function stopPump(Request $request)   // POST
```

### Nutrient Management
```php
public function triggerNutrient(Request $request)
// Request: { "amount": 20 } // in ml
```

### pH Adjustment
```php
public function adjustPh(Request $request)
// Request: { "amount": 5 }  // in ml
```

### Reports
```php
public function downloadReport()
// Generate and download PDF report
```

---

## 7️⃣ Blade Templates

All templates located in: `resources/views/hydroponic/`

### Main Layout
```
dashboard.blade.php
├── @include('partials.header')
├── @include('partials.monitoring-cards')
├── @include('partials.live-charts')
├── @include('partials.weekly-analytics')
├── @include('partials.recommendations')
├── @include('partials.download-section')
├── @include('partials.control-panel')
├── @include('partials.activity-log')
└── @include('partials.footer')
```

---

## 8️⃣ Chart Libraries

### Live Charts (24-hour)
```javascript
// Uses Chart.js
// File: resources/views/hydroponic/partials/live-charts.blade.php
// Charts: pH Trend & PPM Trend
```

### Weekly Analytics Chart
```javascript
// Uses Chart.js
// File: resources/views/hydroponic/partials/weekly-analytics.blade.php
// Chart: Dual-axis (pH & PPM)
```

---

## 9️⃣ Styling

### Tailwind CSS Configuration
```
tailwind.config.js - Main config file
postcss.config.mjs - PostCSS setup
```

### CSS Classes Used
- `bg-card` - Card background
- `border-border` - Border color
- `text-foreground` - Text color
- `text-muted-foreground` - Muted text
- Custom gradient classes

---

## 🔟 Testing

### Manual Testing Checklist

- [ ] Dashboard loads without errors
- [ ] Sensor readings display correctly
- [ ] Charts render properly
- [ ] Pump controls respond
- [ ] Nutrient doser works
- [ ] pH adjustment functions
- [ ] Activity log displays
- [ ] Recommendations show
- [ ] Download report works
- [ ] Mobile responsive

### Browser Requirements
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

---

## 🔧 Troubleshooting

### Issue: Dashboard not loading
```
1. Check Laravel logs: storage/logs/laravel.log
2. Verify routes: php artisan route:list
3. Check JavaScript console (F12)
```

### Issue: Charts not displaying
```
1. Verify Chart.js is loaded
2. Check console for errors
3. Ensure data format matches expected structure
```

### Issue: Controls not working
```
1. Check CSRF token presence
2. Verify route is POST
3. Check controller implementation
4. Review Network tab (F12)
```

---

## 📝 Notes

### Current Implementation
- ✅ All frontend components converted
- ✅ Chart.js integrated
- ✅ Alpine.js interactive controls
- ⏳ Using sample data (not connected to database)

### To Connect Real Sensors
1. Setup `SensorReading` model and database
2. Update controller methods to query database
3. Setup IoT API endpoint
4. Implement Websocket for real-time updates

### To Generate PDF Reports
1. Install DomPDF: `composer require barryvdh/laravel-dompdf`
2. Create report template
3. Implement `downloadReport()` method

---

## 📚 Additional Resources

### Documentation
- [HYDROPONIC_CONVERSION.md](./HYDROPONIC_CONVERSION.md) - Detailed conversion notes
- [CONVERSION_COMPLETE.md](./CONVERSION_COMPLETE.md) - Project summary

### External Links
- [Laravel Docs](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Chart.js](https://www.chartjs.org)

---

## 🎯 Next Steps

### Phase 2: Database Integration
```bash
1. Create migrations for sensor_readings & activity_logs
2. Create models with relationships
3. Update HydroponicController to use models
4. Implement data seeding
```

### Phase 3: IoT Integration
```bash
1. Create API endpoint for sensor data upload
2. Setup Websocket for real-time updates
3. Implement authentication for IoT devices
4. Add data validation & error handling
```

### Phase 4: Advanced Features
```bash
1. PDF report generation
2. Data export (CSV, Excel)
3. Alert notifications
4. Historical data analysis
5. Prediction models
```

---

## 💡 Tips

- Use `php artisan tinker` to test controllers
- Check `storage/logs/laravel.log` for errors
- Use Network tab (F12) to debug API calls
- Use `php artisan route:list` to view all routes
- Use `php artisan migrate:refresh` to reset database

---

**Happy Monitoring! 🌱**

*Last updated: March 7, 2026*
