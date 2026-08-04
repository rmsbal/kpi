# KPI Plugin for Kanboard

A modern **Key Performance Indicator (KPI)** plugin for **Kanboard** that enables organizations to define, monitor, and evaluate employee and project performance directly within Kanboard.

## Features

* 📊 KPI Dashboard
* 🎯 Define KPI Categories and Metrics
* 📅 Monthly, Quarterly, and Annual Evaluation
* 👥 Employee Performance Tracking
* 📈 Performance Trends and Analytics
* 🏆 Automatic KPI Score Calculation
* 🚦 KPI Status Indicators
* 📋 Department and Team Reports
* 📤 Export Reports (CSV/PDF - Planned)
* 🔐 Role-based Permissions
* ⚡ Native Kanboard Integration

## Screenshots

> Screenshots will be added after the first stable release.

---

## Requirements

* Kanboard **v1.2+**
* PHP **8.1+**
* MySQL, MariaDB, PostgreSQL, or SQLite
* Composer

---

## Installation

Clone the repository into the Kanboard `plugins` directory.

```bash
cd plugins
git clone https://github.com/rmsbal/kpi-plugin.git KPI
```

Enable the plugin by logging into Kanboard and navigating to:

```
Settings → Plugins
```

Locate **KPI Plugin** and activate it.

---

## Project Structure

```
KPI/
│
├── Controller/
├── Model/
├── Template/
├── Schema/
├── Helper/
├── Asset/
│   ├── CSS/
│   └── JS/
├── Locale/
├── Plugin.php
└── README.md
```

---

## Planned Roadmap

### Phase 1

* KPI Categories
* KPI Definitions
* KPI Targets
* KPI Weight Management
* Database Schema

### Phase 2

* Employee Assignment
* KPI Evaluation
* Score Calculation
* Dashboard Widgets

### Phase 3

* Charts
* Leaderboards
* Reports
* Notifications

### Phase 4

* Export to Excel/PDF
* REST API
* Advanced Analytics
* Historical Performance

---

## Development

Clone the repository:

```bash
git clone https://github.com/rmsbal/kpi-plugin.git
```

Create a feature branch:

```bash
git checkout -b feature/new-feature
```

Commit your changes:

```bash
git commit -m "Add new feature"
```

Push your branch:

```bash
git push origin feature/new-feature
```

Open a Pull Request.

---

## Contributing

Contributions are welcome.

Please:

* Fork the repository
* Create a feature branch
* Follow Kanboard coding standards
* Submit a Pull Request

---

## Issues

If you discover a bug or have a feature request, please create an issue in the GitHub repository.

---

## Author

**Mark B. Balbin**

* GitHub: https://github.com/rmsbal

---

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

---

## Acknowledgements

* Kanboard
* Kanboard Community
* Open Source Contributors
