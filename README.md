# NexusCRM - Lightweight Client Relationship Management System

## Project Overview
NexusCRM is a lightweight, user-friendly and minimal Client Relationship Management system specifically designed for small operations, freelancers and academic-level implementations. The system focuses on essential CRM functions while maintaining simplicity, practicality and a beautiful, modern interface with custom CSS styling.

## Design Philosophy

- **Custom Vanilla CSS**: All styling is implemented with custom CSS variables and vanilla CSS (no Tailwind/Bootstrap)
- **Consistent Color Palette**: Uses a carefully selected color scheme throughout the application
- **Fully Responsive**: Adapts seamlessly to desktop, tablet, and mobile devices
- **Dark/Light Theme**: Built-in theme toggle with CSS variables
- **Modern UI**: Clean, minimalistic interface focused on usability

## Core Features

### **Authentication System**
- User registration and login with secure sessions
- Password reset functionality
- Email verification
- Profile management with account settings

### **Client Management**
- Complete CRUD operations (Create, Read, Update, Delete)
- Centralized client records with structured data storage
- Client search and filtering by status, name, email, or company
- Client status tracking (Lead, Active, Inactive)

### **Notes & Activity Tracking**
- Add detailed notes for each client interaction
- Categorize notes by type (Call, Meeting, Email, General)
- Activity timeline showing chronological client interactions
- Note management with edit and delete capabilities

### **Smart Follow-up System**
- Set and manage "Next Follow-up Dates" for each client
- Today's Follow-ups dashboard for immediate actions
- Upcoming follow-ups view (7-day preview)
- Overdue follow-up alerts and notifications
- Weekly follow-up distribution visualization

### **Dashboard & Analytics**
- Comprehensive dashboard with key metrics
- Statistics cards showing:
  - Total number of clients
  - Number of follow-ups due today
  - Active clients count
  - Leads count
  - Total notes
- Weekly follow-up histogram with capping visualization
- Most active clients display
- Recent activity timeline

### **Advanced Reporting System**
- **Three Report Types**:
  1. **Overview Report** - Key stats and recent activity
  2. **Detailed Report** - Complete client and activity data
  3. **Follow-ups Report** - Pending and upcoming follow-ups with priority indicators
- PDF generation with professional formatting
- Downloadable reports with watermark protection
- Custom CSS for print/PDF optimization

### **User Experience Features**
- Fully responsive design for all screen sizes
- Light/Dark theme toggle with persistent settings
- Smooth animations and transitions
- Intuitive navigation with active state indicators
- Color-coded status badges and priority indicators
- Interactive charts and visualizations

## Technology Stack

### Backend
- **Framework**: Laravel 10.x (PHP)
- **Database**: SQLite (Lightweight, no external server required)
- **PDF Generation**: DomPDF
- **Authentication**: Laravel Breeze
- **Server**: Laravel Development Server

### Frontend
- **Templating Engine**: Blade Templates
- **Styling**: Custom Vanilla CSS with CSS Variables
- **JavaScript**: Vanilla JavaScript (No frameworks)
- **Icons**: SVG icons embedded directly
- **Charts**: Custom CSS-based visualizations
- **Font**: Inter (Google Fonts)

### Development Tools
- **Package Manager**: Composer
- **Version Control**: Git
- **Code Editor**: VS Code
- **Local Development**: Built-in Laravel server


## Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer (PHP dependency manager)
- Git

### Quick Installation
1. **Clone the repository**
   ```bash
   git clone https://github.com/Ishrak-Saleh/nexuscrm.git
   cd nexuscrm
   ```
2. **Install PHP dependencies**
   ```bash
   composer install
   ```
3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Setup SQLite database**
   ```bash
   touch database/database.sqlite
   ```
5. **Configure database in .env**
   ```bash
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/nexuscrm/database/database.sqlite
   ```
6. **Run migrations**
   ```bash
   php artisan migrate
   ```
7. **Seed database(Optional for demo data)**
   ```bash
   php artisan db:seed
   ```
8. **Start development server**
   ```bash
   php artisan serve
   ```
9. **Access the application**
   Open the browser and navigate to <http://localhost:8000>

### Demo Credentials
Use these after running the seeder:
- Email: demo@nexuscrm.com
- Password: P@ssword123
   

## **Configurations**
### Environment Variables
- Update .env file with your settings:
```env
APP_NAME=NexusCRM
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# DB_DATABASE= Absolute path to your SQLite file

SESSION_DRIVER=file
SESSION_LIFETIME=120
```
### Database Schema
- Clients Table
```sql
id              INTEGER PRIMARY KEY
user_id         INTEGER (Foreign Key to users)
name            VARCHAR(255)
email           VARCHAR(255) NULLABLE
phone           VARCHAR(20) NULLABLE
company         VARCHAR(255) NULLABLE
address         TEXT NULLABLE
next_follow_up  DATE NULLABLE
status          ENUM('lead', 'active', 'inactive')
created_at      TIMESTAMP
updated_at      TIMESTAMP
```
- Notes Table
```sql
id          INTEGER PRIMARY KEY
client_id   INTEGER (Foreign Key to clients)
user_id     INTEGER (Foreign Key to users)
content     TEXT
type        ENUM('call', 'meeting', 'email', 'general')
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

## Usage Guide

### **Getting Started**
1. **Register/Login**: Create account or use demo credentials
2. **Add Clients**: Click "Add Client" to enter first client
3. **Set Follow-ups**: Schedule next contact date for each client
4. **Add Notes**: Record interactions from client profiles
5. **Use Dashboard**: Monitor metrics and generate reports

### **Daily Workflow**
1. **Check Dashboard**: Review today's follow-ups and weekly distribution
2. **Priority Actions**: Handle "Today's Follow-ups" first
3. **Client Interaction**: Contact clients and add notes immediately
4. **Schedule Next**: Update follow-up dates after each contact
5. **End of Day**: Generate report if needed for record-keeping

### **Generating Reports**
1. Navigate to **Dashboard**
2. Click **"Download Report"** button
3. System generates PDF with:
   - Current statistics
   - Weekly follow-up chart
   - Recent activity summary
   - Most active clients
4. Save or print the professional PDF report


   
##Developer
### Ishrak Saleh Chowdhury
- ID: 232-134-034
- Batch: 5th
- Project: NexusCRM

---
-NexusCRM: Streamlining client relationships with elegance and efficiency
