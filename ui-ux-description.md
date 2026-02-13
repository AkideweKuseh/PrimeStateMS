# 📱 REAL ESTATE MANAGEMENT SYSTEM - COMPLETE UI SCREEN SPECIFICATIONS

## 📋 TABLE OF CONTENTS

1. [Public Pages](#public-pages)
   - Landing Page
   - About Page
   - Contact Page
   - Properties Listing (Public)
   - Property Details (Public)
2. [Authentication Pages](#authentication-pages)
   - Login Page
   - Register Page
   - Forgot Password (Optional)
3. [Admin Dashboard Pages](#admin-dashboard-pages)
   - Dashboard Overview
   - Properties Management
   - Bookings Management
   - Payments Management
   - Reports Section
   - Profile Settings
4. [Client Dashboard Pages](#client-dashboard-pages)
   - Client Dashboard
   - Browse Properties
   - My Bookings
   - My Payments
   - Profile Settings
5. [Shared Components](#shared-components)
6. [Responsive Behavior](#responsive-behavior)

---

## 🌐 PUBLIC PAGES

### 1. LANDING PAGE (Homepage)
**URL:** `/` or `/index.php`  
**Access:** Public (no authentication required)

#### Page Structure:

**A. Navigation Bar (Fixed Top)**
- **Left Side:**
  - Logo/Brand: "Real Estate MS" with icon
  - Company name/tagline

- **Center (Desktop only):**
  - Nav Links:
    - Home (active)
    - Properties
    - About Us
    - Contact Us

- **Right Side:**
  - "Login" button (outline style, primary color)
  - "Register" button (solid style, primary color)

- **Mobile:** Hamburger menu icon revealing side drawer with all links

**B. Hero Section**
- **Layout:** Full-width, min-height 70vh
- **Background:** Large property image with dark overlay (opacity 0.5)
- **Content (Centered):**
  - Main Headline: "Find Your Dream Property" (large, bold, white text)
  - Sub-headline: "Discover the perfect home from thousands of listings" (medium, white text)
  - Quick Search Box:
    - Location input (dropdown or text with autocomplete)
    - Property Type dropdown (House, Apartment, Villa, Land, etc.)
    - Price Range (min-max inputs)
    - Large "Search Properties" button (accent color)
  - Optional: Property count display ("2,500+ Properties Available")

**C. Featured Properties Section**
- **Section Header:**
  - Title: "Featured Properties" (h2, centered)
  - Subtitle: "Hand-picked properties just for you"
  - "View All" link on the right

- **Property Cards Grid:**
  - Layout: 3 columns on desktop, 2 on tablet, 1 on mobile
  - Show 6 featured properties
  - Each card contains:
    - Property image (with "Featured" badge overlay top-left)
    - Property type badge (top-right, e.g., "For Rent", "For Sale")
    - Property title/name
    - Location (with map pin icon): "City, State"
    - Price (large, bold): "GH₵ 2,500/month" or "GH₵ 450,000"
    - Specifications row:
      - Bedrooms (with bed icon): "3 Beds"
      - Bathrooms (with bath icon): "2 Baths"
      - Area (with area icon): "1,500 sqft"
    - "View Details" button (full-width, centered)
    - Hover effect: slight elevation/shadow

**D. Why Choose Us Section**
- **Layout:** 3 columns on desktop, 1 on mobile
- **Section Header:** "Why Choose Us?" (h2, centered)
- **Feature Cards:**
  - Card 1:
    - Icon: Home/Property icon (large, centered)
    - Title: "Wide Range of Properties"
    - Description: "Browse through thousands of verified listings"
  - Card 2:
    - Icon: Security/Shield icon
    - Title: "Secure Transactions"
    - Description: "Your payments and data are 100% secure"
  - Card 3:
    - Icon: Support/Headset icon
    - Title: "24/7 Support"
    - Description: "Our team is always ready to assist you"

**E. How It Works Section**
- **Layout:** Horizontal timeline/steps (4 steps)
- **Section Header:** "How It Works" (h2, centered)
- **Steps:**
  - Step 1: "Search Properties" (icon + number badge)
  - Step 2: "View Details" 
  - Step 3: "Book Property"
  - Step 4: "Make Payment"
- Each step has icon, title, and brief description
- Connected with dotted line or arrow

**F. Statistics Section**
- **Layout:** Full-width, colored background (light blue/gray)
- **Stats Grid:** 4 columns on desktop, 2 on mobile
- **Counter Cards:**
  - Properties Listed (icon + number): "2,500+"
  - Happy Clients: "1,200+"
  - Cities Covered: "15+"
  - Properties Sold: "800+"

**G. Latest Properties Section**
- Similar to Featured Properties but shows most recent listings
- "View All Properties" button at bottom

**H. Testimonials Section (Optional)**
- **Layout:** Carousel/Slider
- **Content:** 3-4 client testimonials
- Each testimonial:
  - Client photo (circular)
  - Quote text
  - Client name
  - Rating stars (5 stars)

**I. Call-to-Action Section**
- **Layout:** Full-width, gradient background
- **Content (Centered):**
  - Title: "Ready to Find Your Dream Property?"
  - Description: "Join thousands of satisfied clients today"
  - "Get Started" button (large, white background)

**J. Footer**
- **Layout:** 4 columns on desktop, stacked on mobile
- **Column 1: About**
  - Company logo
  - Brief description
  - Social media icons
- **Column 2: Quick Links**
  - Home
  - Properties
  - About Us
  - Contact
  - Terms & Conditions
  - Privacy Policy
- **Column 3: Contact Info**
  - Address
  - Phone number
  - Email
  - Working hours
- **Column 4: Newsletter**
  - "Subscribe to our newsletter"
  - Email input + Subscribe button
- **Bottom Bar:**
  - Copyright text: "© 2024 Real Estate MS. All rights reserved."

---

### 2. ABOUT US PAGE
**URL:** `/about.php` or `/views/public/about.php`  
**Access:** Public

#### Page Structure:

**A. Page Header**
- Navigation bar (same as homepage)

**B. Page Banner**
- Title: "About Us" (h1, centered)
- Breadcrumb: Home > About Us
- Background: Subtle image or gradient

**C. Company Story Section**
- **Layout:** 2 columns (image left, text right on desktop)
- **Left Column:**
  - Professional company/office image
- **Right Column:**
  - Title: "Who We Are"
  - Paragraphs about company history, mission, vision
  - Founded year, achievements

**D. Mission & Vision Cards**
- **Layout:** 2 columns
- **Card 1: Our Mission**
  - Icon
  - Mission statement
- **Card 2: Our Vision**
  - Icon
  - Vision statement

**E. Core Values Section**
- **Layout:** 3 or 4 columns
- Each value card:
  - Icon
  - Value name (e.g., "Integrity", "Excellence", "Trust")
  - Brief description

**F. Team Section (Optional)**
- **Layout:** 3-4 columns
- Team member cards:
  - Photo
  - Name
  - Position
  - Social media links

**G. Why Choose Us**
- Similar to homepage but with more detail
- Statistics or achievements

**H. Footer** (same as homepage)

---

### 3. CONTACT US PAGE
**URL:** `/contact.php` or `/views/public/contact.php`  
**Access:** Public

#### Page Structure:

**A. Page Header**
- Navigation bar

**B. Page Banner**
- Title: "Contact Us"
- Subtitle: "Get in touch with us"
- Breadcrumb

**C. Contact Information Cards**
- **Layout:** 3 columns on desktop
- **Card 1: Office Address**
  - Location icon
  - Full address
  - Map link
- **Card 2: Phone**
  - Phone icon
  - Phone numbers (office, mobile)
  - "Call Us" button
- **Card 3: Email**
  - Email icon
  - Email addresses
  - "Email Us" button

**D. Contact Form Section**
- **Layout:** 2 columns (form left, map right)
- **Left Column: Contact Form**
  - Form title: "Send Us a Message"
  - Input Fields:
    - Full Name (required)
    - Email Address (required)
    - Phone Number
    - Subject (required)
    - Message (textarea, required)
  - Submit button: "Send Message"
  - Success/error message display area

- **Right Column: Map**
  - Google Maps embed showing office location
  - Or static map image

**E. Working Hours Section (Optional)**
- Box with office hours
- Monday - Friday: 9:00 AM - 6:00 PM
- Saturday: 10:00 AM - 4:00 PM
- Sunday: Closed

**F. Footer**

---

### 4. PROPERTIES LISTING PAGE (Public)
**URL:** `/properties.php` or `/views/public/properties.php`  
**Access:** Public

#### Page Structure:

**A. Page Header**
- Navigation bar

**B. Page Title Section**
- Title: "Browse Properties"
- Total count: "Showing 48 properties"
- Breadcrumb: Home > Properties

**C. Search & Filter Sidebar (Left Side)**
- **Search Box:**
  - Text input: "Search by title or location"
  - Search button

- **Filter Section:**
  - Title: "Filter Properties"
  
  - **Property Type Filter:**
    - Checkboxes:
      - [ ] House
      - [ ] Apartment
      - [ ] Villa
      - [ ] Land
      - [ ] Commercial
      - [ ] Office
  
  - **Listing Type Filter:**
    - Radio buttons:
      - ( ) All
      - ( ) For Rent
      - ( ) For Sale
  
  - **Price Range Filter:**
    - Min Price input
    - Max Price input
    - Or: Price range slider
  
  - **Location Filter:**
    - City dropdown or text input
  
  - **Bedrooms Filter:**
    - Dropdown: Any, 1+, 2+, 3+, 4+, 5+
  
  - **Status Filter:**
    - Checkboxes:
      - [ ] Available
      - [ ] Booked
  
  - **Area Filter (Optional):**
    - Min area (sqft)
    - Max area (sqft)
  
  - **Action Buttons:**
    - "Apply Filters" (primary button)
    - "Reset Filters" (secondary button)

**D. Main Content Area (Right Side)**

- **Sorting & View Options Bar:**
  - **Left:** "Showing 1-12 of 48 properties"
  - **Center:** 
    - Sort by dropdown: "Most Recent", "Price: Low to High", "Price: High to Low", "Name A-Z"
  - **Right:**
    - View toggle buttons: Grid view icon | List view icon

- **Properties Grid/List:**
  
  **Grid View (Default):**
  - 3 columns on desktop, 2 on tablet, 1 on mobile
  - Property card (same as homepage):
    - Image with hover zoom effect
    - Status badge ("Available", "Booked")
    - Property type badge ("For Rent", "For Sale")
    - Title
    - Location
    - Price
    - Specifications (beds, baths, area)
    - "View Details" button
  
  **List View:**
  - Full-width cards
  - Horizontal layout: Image left, details right
  - Same information as grid but more spacious
  - "View Details" button on right

- **Pagination:**
  - Centered at bottom
  - Previous | 1 | 2 | 3 | ... | 10 | Next
  - Show "10 per page" dropdown option

**E. No Results State:**
- If no properties match filters:
  - Icon (empty box or search icon)
  - Message: "No properties found"
  - Suggestion: "Try adjusting your filters"
  - "Reset Filters" button

**F. Footer**

---

### 5. PROPERTY DETAILS PAGE (Public)
**URL:** `/property-details.php?id=123` or `/views/public/property-details.php?id=123`  
**Access:** Public

#### Page Structure:

**A. Page Header**
- Navigation bar

**B. Breadcrumb**
- Home > Properties > [Property Title]

**C. Property Title Section**
- **Left:**
  - Property title (h1)
  - Location (with pin icon): "City, State"
  - Property ID: "PROP-123"
- **Right:**
  - Price (large, colored): "GH₵ 2,500/month"
  - Status badge: "Available" (green) or "Booked" (red)

**D. Image Gallery Section**
- **Main Image:**
  - Large display (70% width)
  - Lightbox on click
- **Thumbnail Grid:**
  - 4 thumbnails below or to the right (30% width)
  - Click to change main image
  - "View All Photos" button (opens full gallery lightbox)

**E. Property Details Section**
- **Layout:** 2 columns

- **Left Column (70%):**
  
  - **Overview Card:**
    - Title: "Property Overview"
    - Property type: "Apartment"
    - Listing type: "For Rent"
    - Key specs in grid (2 columns):
      - Bedrooms: 3
      - Bathrooms: 2
      - Area: 1,500 sqft
      - Property ID: PROP-123
      - Status: Available
      - Added: 2 weeks ago
  
  - **Description Card:**
    - Title: "Description"
    - Full property description (multiple paragraphs)
  
  - **Features & Amenities Card:**
    - Title: "Features & Amenities"
    - Grid of features (3-4 columns):
      - [✓] Air Conditioning
      - [✓] Parking Space
      - [✓] Balcony
      - [✓] Security
      - [✓] Garden
      - [✓] Internet
      - etc.
  
  - **Location Card:**
    - Title: "Location"
    - Full address
    - Google Maps embed or static map image
    - "View on Google Maps" link

- **Right Column (30%):**
  
  - **Contact Card (Sticky):**
    - Title: "Interested in this property?"
    - If NOT logged in:
      - Message: "Please login to book this property"
      - "Login" button (primary, full-width)
      - "Register" button (outline, full-width)
    - If logged in as CLIENT:
      - "Book Now" button (large, primary, full-width)
      - "Save to Wishlist" button (outline) [Optional]
    - If logged in as ADMIN:
      - "Edit Property" button
      - "Delete Property" button
  
  - **Agent Info Card (Optional):**
    - Agent photo
    - Agent name
    - Phone number
    - Email
    - "Contact Agent" button
  
  - **Share Property Card:**
    - Title: "Share this property"
    - Social share buttons:
      - Facebook
      - Twitter
      - WhatsApp
      - Email
      - Copy link

**F. Similar Properties Section**
- Title: "Similar Properties"
- Horizontal scrollable cards or grid
- Show 3-4 similar properties (same type/location)
- Each card same as homepage property card

**G. Footer**

---

## 🔐 AUTHENTICATION PAGES

### 6. LOGIN PAGE
**URL:** `/login.php` or `/views/auth/login.php`  
**Access:** Public (redirects if already logged in)

#### Page Structure:

**A. Page Layout:**
- Split screen or centered form
- Minimal navigation (just logo/brand, no menu)

**B. Left Side (50% on desktop, hidden on mobile):**
- Background: Property image or brand gradient
- Overlay with:
  - Company logo
  - Tagline: "Welcome Back"
  - Short text about the platform

**C. Right Side (50% on desktop, full-width on mobile):**
- **Card Container (Centered vertically & horizontally):**
  
  - **Header:**
    - Title: "Login to Your Account" (h2)
    - Subtitle: "Enter your credentials to continue"
  
  - **Form:**
    - Email Address input:
      - Label: "Email Address"
      - Placeholder: "Enter your email"
      - Icon: Email icon (left side of input)
      - Required indicator (*)
      - Error message area below
    
    - Password input:
      - Label: "Password"
      - Placeholder: "Enter your password"
      - Icon: Lock icon (left side)
      - Eye icon (right side) to toggle visibility
      - Required indicator (*)
      - Error message area below
    
    - Remember Me checkbox:
      - [ ] Remember me on this device
    
    - Forgot Password link (right-aligned)
      - Text: "Forgot Password?"
      - Link to password reset page
    
    - Login Button:
      - Text: "Login"
      - Full-width
      - Primary color
      - Loading state (spinner when submitting)
    
    - Error Alert Box:
      - Shows server-side errors (e.g., "Invalid credentials")
      - Red background, dismissible
  
  - **Divider:**
    - "OR" text with horizontal lines
  
  - **Social Login (Optional):**
    - "Login with Google" button (white, with Google logo)
    - "Login with Facebook" button (blue, with Facebook logo)
  
  - **Footer:**
    - Text: "Don't have an account?"
    - Link: "Register here" (bold, colored)
    - Back to Home link

**D. Form Validation:**
- Client-side validation:
  - Email format check
  - Password not empty
- Server-side validation messages display in alert box
- Success: Redirect to dashboard (admin or client based on role)

---

### 7. REGISTER PAGE
**URL:** `/register.php` or `/views/auth/register.php`  
**Access:** Public (redirects if already logged in)

#### Page Structure:

**A. Page Layout:**
- Same split-screen or centered layout as login

**B. Left Side:**
- Same as login page but with:
  - Tagline: "Join Us Today"
  - "Start your property search journey"

**C. Right Side:**
- **Card Container:**
  
  - **Header:**
    - Title: "Create Your Account" (h2)
    - Subtitle: "Fill in your details to get started"
  
  - **Form:**
    
    - Full Name input:
      - Label: "Full Name"
      - Placeholder: "Enter your full name"
      - Icon: User icon
      - Required (*)
    
    - Email Address input:
      - Label: "Email Address"
      - Placeholder: "Enter your email"
      - Icon: Email icon
      - Required (*)
      - Validation: Must be valid email format
    
    - Phone Number input:
      - Label: "Phone Number"
      - Placeholder: "+233 XX XXX XXXX"
      - Icon: Phone icon
      - Optional
    
    - Password input:
      - Label: "Password"
      - Placeholder: "Create a password"
      - Icon: Lock icon
      - Eye icon to toggle visibility
      - Required (*)
      - Password strength indicator below:
        - Weak (red) | Medium (orange) | Strong (green)
      - Requirements text:
        - "Must be at least 8 characters"
        - "Include uppercase, lowercase, and number"
    
    - Confirm Password input:
      - Label: "Confirm Password"
      - Placeholder: "Re-enter your password"
      - Icon: Lock icon
      - Required (*)
      - Real-time validation (matches password or not)
    
    - Account Type selection (Optional):
      - Label: "Register as"
      - Radio buttons:
        - ( ) Client (looking for property)
        - ( ) Agent (listing properties) [Optional feature]
    
    - Terms & Conditions checkbox:
      - [ ] I agree to the Terms & Conditions and Privacy Policy
      - Required (*)
      - Links to open terms in modal or new page
    
    - Register Button:
      - Text: "Create Account"
      - Full-width
      - Primary color
      - Loading state
    
    - Error/Success Alert Box:
      - Shows validation errors or success messages
  
  - **Divider:**
    - "OR" text
  
  - **Social Registration (Optional):**
    - "Sign up with Google"
    - "Sign up with Facebook"
  
  - **Footer:**
    - Text: "Already have an account?"
    - Link: "Login here" (bold, colored)
    - Back to Home link

**D. Form Validation:**
- Client-side:
  - All required fields filled
  - Email format valid
  - Password meets requirements
  - Passwords match
  - Terms accepted
- Server-side:
  - Email not already registered
  - All validations passed
- Success: 
  - Show success message: "Account created successfully!"
  - Redirect to login page after 2 seconds

---

### 8. FORGOT PASSWORD PAGE (Optional)
**URL:** `/forgot-password.php`  
**Access:** Public

#### Page Structure:

**A. Similar Layout to Login/Register**

**B. Form Card:**
- **Header:**
  - Icon: Lock with question mark
  - Title: "Forgot Your Password?"
  - Subtitle: "Enter your email to reset your password"

- **Form:**
  - Email input
  - "Send Reset Link" button
  - Success message: "Password reset link sent to your email"
  
- **Footer:**
  - "Remember your password?" link to login
  - "Back to Home" link

---

## 👨‍💼 ADMIN DASHBOARD PAGES

### 9. ADMIN DASHBOARD (Overview)
**URL:** `/admin/dashboard.php` or `/views/admin/dashboard.php`  
**Access:** Admin only

#### Page Structure:

**A. Top Navigation Bar (Fixed)**
- **Left:**
  - Logo/Brand name
  - Dashboard title
- **Right:**
  - Search bar (global search)
  - Notification bell icon (with badge count)
  - Admin profile dropdown:
    - Profile photo (circular)
    - Admin name
    - Dropdown menu:
      - View Profile
      - Settings
      - Logout

**B. Sidebar (Left, Fixed)**
- **Profile Section:**
  - Admin photo (circular)
  - Admin name
  - Role badge: "Administrator"

- **Navigation Menu:**
  - Dashboard (icon + text, active state highlighted)
  - Properties
    - All Properties
    - Add New Property
    - Property Types
  - Bookings
    - All Bookings
    - Pending Bookings
    - Completed Bookings
  - Payments
    - All Payments
    - Record Payment
    - Payment Reports
  - Reports
    - Property Reports
    - Booking Reports
    - Revenue Reports
  - Users (Optional)
    - All Users
    - Add User
  - Settings
  
- **Footer:**
  - "Need Help?" link
  - Version number

**C. Main Content Area**

- **Page Header:**
  - Title: "Dashboard Overview"
  - Breadcrumb: Home > Dashboard
  - Date/Time display
  - "Refresh" button

- **Statistics Cards Row:**
  - **Layout:** 4 cards in a row (responsive: 2x2 on tablet, stacked on mobile)
  
  - **Card 1: Total Properties**
    - Icon: Building icon (colored background circle)
    - Number: "248" (large, bold)
    - Label: "Total Properties"
    - Trend indicator: "+12% from last month" (green with up arrow)
    - Background: Gradient or solid color
  
  - **Card 2: Total Bookings**
    - Icon: Calendar icon
    - Number: "156"
    - Label: "Total Bookings"
    - Trend: "+8% from last month"
  
  - **Card 3: Total Revenue**
    - Icon: Money/Chart icon
    - Number: "GH₵ 485,600"
    - Label: "Total Revenue"
    - Trend: "+15% from last month"
  
  - **Card 4: Pending Bookings**
    - Icon: Clock icon
    - Number: "23"
    - Label: "Pending Bookings"
    - "View All" link
    - Warning color if number is high

- **Charts Section:**
  
  - **Row 1: Two Charts (2 columns)**
    
    - **Left: Bookings Overview (Line Chart)**
      - Card title: "Bookings Over Time"
      - Date range selector: "Last 6 Months" dropdown
      - Chart: Line chart showing bookings per month
      - Legend: Total Bookings, Completed, Cancelled
      - Export button (CSV/PDF)
    
    - **Right: Properties by Type (Doughnut Chart)**
      - Card title: "Properties Distribution"
      - Chart: Doughnut chart showing:
        - Houses: 35%
        - Apartments: 40%
        - Villas: 15%
        - Land: 10%
      - Legend with color codes
      - Total count in center
  
  - **Row 2: Full-Width Chart**
    
    - **Revenue Chart (Bar Chart)**
      - Card title: "Monthly Revenue"
      - Filter: "This Year" dropdown (2024, 2023, etc.)
      - Chart: Bar chart showing revenue per month
      - Y-axis: Revenue amount
      - X-axis: Months
      - Hover tooltip showing exact figures

- **Recent Activity Section:**
  
  - **Layout:** 2 columns
  
  - **Left: Recent Bookings Table**
    - Card title: "Recent Bookings"
    - "View All" link
    - Table:
      - Columns: Booking ID | Client Name | Property | Date | Status | Action
      - Show 5 most recent bookings
      - Status badges (colored): Pending, Confirmed, Completed
      - Action: "View" icon button
    - If no bookings: Empty state message
  
  - **Right: Recent Payments Table**
    - Card title: "Recent Payments"
    - "View All" link
    - Table:
      - Columns: Payment ID | Booking ID | Amount | Method | Date | Status
      - Show 5 most recent payments
      - Status badges: Pending, Verified, Rejected
    - If no payments: Empty state message

- **Quick Actions Section (Optional):**
  - Large button cards:
    - "+ Add New Property"
    - "📋 View Bookings"
    - "💰 Record Payment"
    - "📊 Generate Report"

---

### 10. ADMIN - ALL PROPERTIES PAGE
**URL:** `/admin/properties/index.php` or `/views/admin/properties/index.php`  
**Access:** Admin only

#### Page Structure:

**A. Layout:**
- Top nav + Sidebar (same as dashboard)

**B. Page Header:**
- Title: "All Properties"
- Breadcrumb: Dashboard > Properties
- "+ Add New Property" button (primary, top-right)

**C. Filter & Search Bar:**
- **Left:**
  - Search input: "Search by title, location..."
  - Search button
- **Right:**
  - Filter dropdown: "All Types" | "House" | "Apartment" | etc.
  - Filter dropdown: "All Status" | "Available" | "Booked" | "Sold"
  - Filter dropdown: "Sort by" (Most Recent, Price, Name)

**D. Properties Table:**
- **Table Layout:**
  - Responsive: Scrollable on mobile
  - Columns:
    1. **Image** (thumbnail, 80x80px)
    2. **Property Details**
       - Title (bold)
       - Location (small text, gray)
       - ID (small text)
    3. **Type** (badge: House, Apartment, etc.)
    4. **Listing Type** (badge: For Rent, For Sale)
    5. **Price** (bold, colored)
    6. **Status** (badge: Available-green, Booked-orange, Sold-red)
    7. **Date Added** (format: "2 Jan 2024")
    8. **Actions**
       - View icon (eye)
       - Edit icon (pencil)
       - Delete icon (trash)
       - Dropdown "..." for more options

- **Table Features:**
  - Checkbox column (first column) for bulk actions
  - Bulk actions bar (appears when items selected):
    - "Delete Selected" button
    - "Change Status" dropdown
  - Sorting: Click column headers to sort
  - Row hover effect

**E. Pagination:**
- Bottom of page
- "Showing 1-20 of 248 properties"
- Previous | 1 | 2 | 3 | ... | 13 | Next
- "20 per page" dropdown

**F. Empty State:**
- If no properties:
  - Icon (empty folder)
  - Message: "No properties found"
  - "Add your first property" button

---

### 11. ADMIN - ADD NEW PROPERTY PAGE
**URL:** `/admin/properties/create.php`  
**Access:** Admin only

#### Page Structure:

**A. Layout:**
- Top nav + Sidebar

**B. Page Header:**
- Title: "Add New Property"
- Breadcrumb: Dashboard > Properties > Add New
- "Cancel" button (goes back to properties list)

**C. Form Layout:**
- **Card-based form with sections**

**Section 1: Basic Information**
- Card title: "Basic Information"
- Fields:
  - Property Title (text input, required)
    - Placeholder: "e.g., Modern 3-Bedroom Apartment"
  - Property Description (textarea, required)
    - Rich text editor or plain textarea
    - Character counter (min 100 characters)
  - Property Type (select dropdown, required)
    - Options: House, Apartment, Villa, Land, Commercial, Office
  - Listing Type (radio buttons, required)
    - ( ) For Rent
    - ( ) For Sale

**Section 2: Location Details**
- Card title: "Location Details"
- Fields (2 columns layout):
  - Address (text input, required)
  - City (text input or dropdown, required)
  - State/Province (text input or dropdown, required)
  - ZIP/Postal Code (text input)
  - Country (dropdown, default: "Ghana")

**Section 3: Property Specifications**
- Card title: "Property Specifications"
- Fields (3 columns layout):
  - Bedrooms (number input, min: 0)
  - Bathrooms (number input, min: 0)
  - Area (number input, label: "Area in sqft")
  - Price (number input, required, label: "Price in GH₵")

**Section 4: Property Images**
- Card title: "Property Images"
- **Main Image:**
  - Label: "Main Property Image (Required)"
  - File upload area (drag & drop or click to browse)
  - Accepted: JPG, PNG, GIF (Max 5MB)
  - Preview area (shows selected image)
  - "Remove" button if image selected

- **Additional Images (Optional):**
  - Label: "Additional Images (Up to 5)"
  - Multiple file upload area
  - Grid preview of selected images (thumbnail size)
  - "Remove" button on each thumbnail
  - Upload requirements displayed

**Section 5: Features & Amenities (Optional)**
- Card title: "Features & Amenities"
- Checkbox grid (3-4 columns):
  - [ ] Air Conditioning
  - [ ] Parking Space
  - [ ] Balcony
  - [ ] Garden
  - [ ] Swimming Pool
  - [ ] Security System
  - [ ] Internet/WiFi
  - [ ] Gym
  - [ ] Elevator
  - [ ] Furnished
  - [ ] Pet Friendly
  - [ ] Fireplace
  - (Add more as needed)

**Section 6: Property Status**
- Card title: "Property Status"
- Status dropdown:
  - Available (default)
  - Unavailable
- Featured Property checkbox:
  - [ ] Mark as featured (shows on homepage)

**D. Form Actions:**
- **Bottom Action Bar (Sticky):**
  - "Save as Draft" button (secondary, left)
  - "Cancel" button (outline)
  - "Publish Property" button (primary, large, right)

**E. Form Validation:**
- Required field indicators (*)
- Real-time validation messages
- Success message: "Property added successfully!"
- Error messages for each field if validation fails

---

### 12. ADMIN - EDIT PROPERTY PAGE
**URL:** `/admin/properties/edit.php?id=123`  
**Access:** Admin only

#### Page Structure:

**A. Layout:**
- Same as Add Property page
- Page title: "Edit Property"
- Breadcrumb: Dashboard > Properties > Edit

**B. Form:**
- Identical to Add Property form
- All fields pre-filled with existing property data
- Image previews show existing images
- "Update Property" button instead of "Publish"
- "Delete Property" button (red, with confirmation modal)

**C. Additional Features:**
- "View Live Property" link (opens public property details page)
- Last updated timestamp shown
- Change log (optional): Shows who edited and when

---

### 13. ADMIN - VIEW PROPERTY PAGE
**URL:** `/admin/properties/view.php?id=123`  
**Access:** Admin only

#### Page Structure:

**A. Layout:**
- Top nav + Sidebar

**B. Page Header:**
- Title: Property title
- Breadcrumb: Dashboard > Properties > [Property Name]
- Action buttons:
  - "Edit" button
  - "Delete" button
  - "View Public Page" link

**C. Property Details Display:**
- Similar to public property details page but with admin information
- Additional sections:
  - **Admin Info Card:**
    - Added by: Admin name
    - Date added
    - Last updated
    - Views count
  - **Booking History:**
    - Table of all bookings for this property
    - Columns: Booking ID, Client, Dates, Status, Amount
    - "View Booking" links
  - **Revenue Generated:**
    - Total revenue from this property
    - Number of bookings
    - Average booking value

---

### 14. ADMIN - ALL BOOKINGS PAGE
**URL:** `/admin/bookings/index.php`  
**Access:** Admin only

#### Page Structure:

**A. Layout:**
- Top nav + Sidebar

**B. Page Header:**
- Title: "All Bookings"
- Breadcrumb: Dashboard > Bookings
- Statistics cards (small, in row):
  - Total Bookings
  - Pending (orange badge)
  - Confirmed (blue badge)
  - Completed (green badge)
  - Cancelled (red badge)

**C. Filter Tabs:**
- Tab navigation:
  - All Bookings (active, shows count)
  - Pending (count)
  - Confirmed (count)
  - Completed (count)
  - Cancelled (count)

**D. Search & Filter Bar:**
- Search input: "Search by booking ID, client name, property..."
- Date range picker: "From" - "To" dates
- Status filter dropdown
- "Filter" button
- "Reset" button

**E. Bookings Table:**
- **Columns:**
  1. **Booking ID** (e.g., "BOOK-001")
  2. **Client Details**
     - Client name
     - Phone number
     - Email (small text)
  3. **Property Details**
     - Property title
     - Location
  4. **Booking Date** (format: "2 Jan 2024")
  5. **Duration**
     - Start date
     - End date
     - Or: "3 months" display
  6. **Total Amount** (bold, colored)
  7. **Payment Status**
     - Badge: Pending (orange), Partial (yellow), Completed (green)
  8. **Booking Status**
     - Badge: Pending, Confirmed, Completed, Cancelled
  9. **Actions**
     - View details icon
     - Confirm booking icon (if pending)
     - Cancel booking icon
     - Dropdown "..." menu:
       - View Details
       - Confirm Booking
       - Record Payment
       - Cancel Booking
       - Print Details

**F. Bulk Actions:**
- Checkbox column
- Bulk actions bar:
  - "Confirm Selected"
  - "Cancel Selected"
  - "Export Selected" (CSV)

**G. Pagination:**
- Standard pagination component

**H. Empty State:**
- If no bookings in selected filter

---

### 15. ADMIN - VIEW BOOKING DETAILS PAGE
**URL:** `/admin/bookings/view.php?id=123`  
**Access:** Admin only

#### Page Structure:

**A. Page Header:**
- Title: "Booking Details - BOOK-123"
- Breadcrumb: Dashboard > Bookings > BOOK-123
- Action buttons:
  - "Print" button
  - "Send Email" button (to client)
  - Status action button (e.g., "Confirm Booking", "Cancel Booking")

**B. Layout: 2 Columns**

**Left Column (70%):**

- **Booking Information Card:**
  - Booking ID
  - Booking date
  - Booking status (large badge)
  - Payment status (large badge)

- **Client Information Card:**
  - Client name
  - Email
  - Phone
  - Profile picture
  - "View Client Profile" link

- **Property Information Card:**
  - Property image (small)
  - Property title
  - Property type
  - Location
  - Price
  - "View Property" link

- **Booking Dates Card:**
  - Start date
  - End date
  - Duration
  - Move-in instructions (if any)

- **Payment Details Card:**
  - Total booking amount
  - Amount paid
  - Balance remaining
  - Payment method
  - Transaction references
  - Payment history table:
    - Date | Amount | Method | Status | Receipt link

- **Notes Card:**
  - Client's special requests/notes
  - Admin notes (editable by admin)
  - Text area to add new notes

**Right Column (30%):**

- **Quick Actions Card:**
  - "Confirm Booking" button (if pending)
  - "Record Payment" button
  - "Cancel Booking" button (red)
  - "Print Details" button
  - "Send Confirmation Email" button

- **Timeline Card:**
  - Visual timeline of booking status changes
  - Shows:
    - Booking created
    - Payment received
    - Booking confirmed
    - Property handover
    - Booking completed

- **Related Bookings Card (Optional):**
  - Other bookings by same client
  - Mini cards with basic info

---

### 16. ADMIN - ALL PAYMENTS PAGE
**URL:** `/admin/payments/index.php`  
**Access:** Admin only

#### Page Structure:

**A. Page Header:**
- Title: "All Payments"
- Breadcrumb: Dashboard > Payments
- "+ Record Payment" button (top-right)
- Statistics cards row:
  - Total Revenue
  - Payments This Month
  - Pending Verification
  - Average Payment

**B. Filter & Search:**
- Search: "Search by booking ID, transaction ref..."
- Date range picker
- Payment method filter
- Payment status filter
- "Apply" and "Reset" buttons

**C. Payments Table:**
- **Columns:**
  1. **Payment ID** (e.g., "PAY-001")
  2. **Booking ID** (clickable link)
  3. **Client Name**
  4. **Property** (title)
  5. **Amount** (bold, large, colored)
  6. **Payment Method** (badge: Cash, Bank Transfer, Mobile Money, etc.)
  7. **Transaction Ref** (if applicable)
  8. **Payment Date**
  9. **Status**
     - Badge: Pending (orange), Verified (green), Rejected (red)
  10. **Recorded By** (admin name)
  11. **Actions**
      - View details
      - Verify payment (if pending)
      - Reject payment (if pending)
      - View receipt
      - Edit
      - Delete
      - "..." dropdown menu

**D. Bulk Actions:**
- Select payments
- "Verify Selected"
- "Export Selected"

**E. Pagination**

**F. Empty State**

---

### 17. ADMIN - RECORD PAYMENT PAGE
**URL:** `/admin/payments/record.php`  
**Access:** Admin only

#### Page Structure:

**A. Page Header:**
- Title: "Record Payment"
- Breadcrumb: Dashboard > Payments > Record Payment

**B. Form Layout:**

**Card: Payment Details**

- **Booking Selection:**
  - Searchable dropdown: "Select Booking"
  - Shows: Booking ID - Client Name - Property
  - After selection, displays:
    - Booking details summary (read-only)
    - Total amount due
    - Amount already paid
    - Balance remaining

- **Payment Information:**
  - Amount (number input, required)
    - Auto-fills with balance remaining
    - Can be edited (for partial payments)
    - Shows if amount exceeds balance
  
  - Payment Date (date picker, required)
    - Defaults to today
  
  - Payment Method (dropdown, required)
    - Cash
    - Bank Transfer
    - Mobile Money
    - Credit Card
    - Debit Card
  
  - Transaction Reference (text input)
    - Required if payment method is not Cash
    - Placeholder: "Enter transaction/reference number"
  
  - Payment Status (radio buttons)
    - ( ) Pending Verification
    - ( ) Verified (default)
  
  - Notes (textarea, optional)
    - Placeholder: "Add any additional notes..."

- **Receipt Upload (Optional):**
  - File upload for payment proof
  - Accepted: PDF, JPG, PNG

**C. Form Actions:**
- "Cancel" button
- "Record Payment" button (primary, large)

**D. Success Handling:**
- After recording:
  - Show success message
  - Option to:
    - "View Receipt"
    - "Record Another Payment"
    - "Back to Payments"

---

### 18. ADMIN - PAYMENT RECEIPT PAGE
**URL:** `/admin/payments/receipt.php?id=123`  
**Access:** Admin only (Printable)

#### Page Structure:

**A. Print-Friendly Layout:**
- Minimal UI (hide navigation when printing)
- "Print" button (top-right)
- "Download PDF" button

**B. Receipt Content:**

- **Header:**
  - Company logo (left)
  - Company details (right):
    - Company name
    - Address
    - Phone
    - Email
    - Website
  - Title: "PAYMENT RECEIPT" (centered, large)

- **Receipt Details:**
  - Receipt Number: PAY-123
  - Date: 15 January 2024

- **Bill To:**
  - Client name
  - Client email
  - Client phone

- **Payment Details Table:**
  - Description | Amount
  - Booking ID: BOOK-456
  - Property: [Property Name]
  - Payment for: [Duration/Description]
  - Amount Paid: **GH₵ 2,500.00**
  
- **Payment Information:**
  - Payment Method: Bank Transfer
  - Transaction Reference: TRANS-789
  - Payment Date: 15 Jan 2024
  - Received By: [Admin Name]

- **Payment Summary:**
  - Subtotal: GH₵ 2,500.00
  - Tax (if any): GH₵ 0.00
  - **Total Paid: GH₵ 2,500.00**

- **Booking Summary:**
  - Total Booking Amount: GH₵ 5,000.00
  - Amount Paid: GH₵ 2,500.00
  - **Balance Due: GH₵ 2,500.00**

- **Footer:**
  - Thank you message
  - Company stamp/signature area
  - Terms & conditions (small text)
  - "This is a computer-generated receipt"

**C. Print Styling:**
- Clean, professional design
- Black and white friendly
- Clear typography
- No page breaks in middle of content

---

### 19. ADMIN - REPORTS DASHBOARD
**URL:** `/admin/reports/index.php`  
**Access:** Admin only

#### Page Structure:

**A. Page Header:**
- Title: "Reports & Analytics"
- Breadcrumb: Dashboard > Reports
- Date range selector (global for all reports)
  - Presets: Today | This Week | This Month | This Year | Custom Range
- "Export All" button (PDF/CSV)

**B. Report Sections:**

**Section 1: Overview Statistics**
- 4 large stat cards:
  - Total Revenue (with comparison to previous period)
  - Total Properties Listed
  - Total Bookings
  - Occupancy Rate (%)

**Section 2: Revenue Reports**
- Card title: "Revenue Analysis"
- Tabs:
  - Overview
  - By Property Type
  - By Month
  - By Payment Method

- **Charts:**
  - Revenue trend line chart (monthly)
  - Revenue by property type (bar chart)
  - Payment methods distribution (pie chart)

- **Table: Top Performing Properties**
  - Columns: Property | Type | Total Bookings | Revenue | Avg. Revenue/Booking
  - Top 10 properties

**Section 3: Booking Reports**
- Card title: "Booking Statistics"
- **Charts:**
  - Bookings over time (line/area chart)
  - Booking status distribution (doughnut chart)
  - Bookings by property type (bar chart)

- **Table: Recent Bookings Summary**
  - Summary metrics by period

**Section 4: Property Reports**
- Card title: "Property Analysis"
- **Charts:**
  - Properties by type (pie chart)
  - Properties by status (bar chart: Available, Booked, Sold)
  - Property pricing distribution (histogram)

- **Table: Property Performance**
  - Property | Views | Bookings | Revenue | Booking Rate

**Section 5: Client Reports (Optional)**
- Top clients by:
  - Number of bookings
  - Total spending
- New vs. returning clients

**C. Export Options:**
- Each section has "Export" button
- Options: PDF, CSV, Excel

**D. Schedule Reports (Optional):**
- "Schedule Report" button
- Modal to schedule email delivery:
  - Report type
  - Frequency (Daily, Weekly, Monthly)
  - Email recipients

---

### 20. ADMIN - SETTINGS PAGE
**URL:** `/admin/settings.php`  
**Access:** Admin only

#### Page Structure:

**A. Settings Tabs (Left Sidebar):**
- Profile Settings
- System Settings
- Email Settings
- Payment Settings
- Security Settings

**B. Profile Settings Tab:**
- Admin profile photo
  - Upload new photo button
  - Remove photo button
- Personal information form:
  - Full Name
  - Email
  - Phone
  - Address
- Change Password section:
  - Current Password
  - New Password
  - Confirm New Password
  - "Update Password" button
- "Save Changes" button

**C. System Settings Tab:**
- Application settings:
  - Site Name
  - Site Description
  - Contact Email
  - Contact Phone
  - Address
  - Timezone
  - Date Format
  - Currency
- Upload logo
- "Save Settings" button

**D. Email Settings Tab (Optional):**
- Email notifications toggles:
  - [ ] Email on new booking
  - [ ] Email on payment received
  - [ ] Daily summary email
- SMTP configuration (if implementing email)

**E. Payment Settings Tab:**
- Accepted payment methods (checkboxes):
  - [ ] Cash
  - [ ] Bank Transfer
  - [ ] Mobile Money
  - [ ] Credit/Debit Card
- Payment gateway settings (if applicable)

**F. Security Settings Tab:**
- Session timeout
- Password requirements
- Two-factor authentication (optional)
- Login attempt limits

---

## 👨‍💻 CLIENT DASHBOARD PAGES

### 21. CLIENT DASHBOARD (Overview)
**URL:** `/client/dashboard.php` or `/views/client/dashboard.php`  
**Access:** Client only

#### Page Structure:

**A. Top Navigation:**
- Same structure as admin but simplified
- Logo + "Real Estate MS"
- Right side:
  - Search properties
  - Notifications
  - Profile dropdown

**B. Sidebar (Optional - or horizontal navigation):**
- Dashboard
- Browse Properties
- My Bookings
- My Payments
- Saved Properties (Optional)
- Profile
- Logout

**C. Welcome Section:**
- "Welcome back, [Client Name]!"
- Current date and time

**D. Quick Stats Cards:**
- Layout: 3 cards in row
  
  - **Card 1: Active Bookings**
    - Icon
    - Number: "2"
    - Label: "Active Bookings"
    - "View All" link
  
  - **Card 2: Total Spent**
    - Icon
    - Amount: "GH₵ 15,000"
    - Label: "Total Spent"
    - "View Payments" link
  
  - **Card 3: Saved Properties**
    - Icon
    - Number: "8"
    - Label: "Saved Properties"
    - "View All" link

**E. My Active Bookings Section:**
- Card title: "My Active Bookings"
- "View All" link
- Booking cards (horizontal cards):
  - Each card shows:
    - Property image (left)
    - Property title
    - Booking dates
    - Status badge
    - Payment status
    - "View Details" button
- Show 2-3 most recent
- If no bookings:
  - Empty state: "You don't have any active bookings"
  - "Browse Properties" button

**F. Recommended Properties Section:**
- Card title: "Recommended for You"
- "View All" link
- Property cards grid (3 columns)
- Based on:
  - Previous bookings
  - Saved properties
  - Popular properties

**G. Recent Activity Section (Optional):**
- Timeline of recent actions:
  - Booking made
  - Payment recorded
  - Property saved
  - etc.

---

### 22. CLIENT - BROWSE PROPERTIES PAGE
**URL:** `/client/properties/index.php`  
**Access:** Client only

#### Page Structure:

**A. Layout:**
- Top nav + Sidebar/Horizontal nav

**B. Page Header:**
- Title: "Browse Properties"
- Breadcrumb: Dashboard > Browse Properties
- View toggle: Grid | List
- Sort dropdown

**C. Filter Sidebar:**
- Same as public properties page filters:
  - Search
  - Property Type
  - Listing Type
  - Price Range
  - Location
  - Bedrooms
  - Bathrooms
  - Area
  - Status (only Available)
  - Apply/Reset buttons

**D. Properties Grid:**
- Same as public but with additional features:
  - Save/Heart icon on each card (to save property)
    - Filled heart if already saved
    - Empty heart if not saved
    - Click to toggle
  - "Book Now" button instead of "View Details"
  - Or both buttons

**E. Property Card Actions:**
- Save to favorites (heart icon)
- Share property
- "Book Now" button (primary)
- "View Details" link

**F. Saved Indicator:**
- If property is saved, show indicator on card

**G. Pagination**

---

### 23. CLIENT - PROPERTY DETAILS PAGE
**URL:** `/client/properties/view.php?id=123`  
**Access:** Client only

#### Page Structure:

**A. Similar to public property details page**

**B. Additional Features:**
- "Book Now" button prominently displayed
- "Save Property" button (heart icon with text)
- If already booked by client:
  - Show message: "You have an active booking for this property"
  - "View My Booking" button
  - Disable "Book Now" button

**C. Booking Section (if available):**
- **Sticky Card (Right side):**
  - Property price (large)
  - "Book This Property" heading
  - Quick booking form:
    - Start Date picker
    - End Date picker (optional for purchases)
    - Duration display (auto-calculated)
    - Total amount display (auto-calculated)
    - "Proceed to Book" button
  - Or just "Book Now" button that goes to full booking page

---

### 24. CLIENT - CREATE BOOKING PAGE
**URL:** `/client/bookings/create.php?property_id=123`  
**Access:** Client only

#### Page Structure:

**A. Page Header:**
- Title: "Book Property"
- Breadcrumb: Dashboard > Browse Properties > Book

**B. Layout: 2 Columns**

**Left Column (60%):**

**Card 1: Property Summary**
- Property image
- Property title
- Property type
- Location
- Price
- "View Full Details" link

**Card 2: Booking Details Form**
- Section title: "Booking Information"
  
  - **Start Date** (date picker, required)
    - Min date: Today
    - Label: "Move-in Date" or "Start Date"
  
  - **End Date** (date picker, optional for purchases)
    - Min date: Start date + 1 day
    - Label: "Move-out Date" or "End Date"
    - Hide if property is for sale
  
  - **Duration Display** (auto-calculated, read-only)
    - Shows: "3 months" or "6 weeks"
  
  - **Special Requests/Notes** (textarea, optional)
    - Placeholder: "Any special requests or requirements?"
    - Max 500 characters

**Card 3: Terms & Conditions**
- Checkbox: [ ] I agree to the booking terms and conditions
- Link to view terms (opens in modal)

**Right Column (40%):**

**Card: Booking Summary (Sticky)**
- Title: "Booking Summary"
- Property name (small text)
- Booking details:
  - Start Date: [Selected date]
  - End Date: [Selected date]
  - Duration: [Calculated duration]
  - Price per month/unit: GH₵ X,XXX
  - Number of periods: X
  - Subtotal: GH₵ X,XXX
  - Service charge (if any): GH₵ XXX
  - **Total Amount: GH₵ X,XXX** (large, bold)
- Divider
- "Proceed to Payment" button (large, full-width, primary)
- Or "Confirm Booking" button (if payment is separate step)
- "Cancel" button (outline)
- Small text: "You won't be charged until booking is confirmed"

**C. Form Actions:**
- "Back to Property" button
- "Confirm Booking" button (primary, large)

**D. Success Handling:**
- After booking:
  - Show success modal:
    - Success icon
    - Message: "Booking submitted successfully!"
    - Booking ID: BOOK-XXX
    - "Your booking is pending confirmation"
    - Action buttons:
      - "View Booking Details"
      - "Browse More Properties"
      - "Make Payment" (if payment is separate)

---

### 25. CLIENT - MY BOOKINGS PAGE
**URL:** `/client/bookings/index.php`  
**Access:** Client only

#### Page Structure:

**A. Page Header:**
- Title: "My Bookings"
- Breadcrumb: Dashboard > My Bookings
- Statistics:
  - Total Bookings: X
  - Active: X
  - Completed: X
  - Cancelled: X

**B. Filter Tabs:**
- All Bookings (active)
- Active
- Pending
- Completed
- Cancelled

**C. Bookings Display:**
- **Layout:** Card-based (not table)
- Each booking card:
  
  - **Card Layout: Horizontal**
    
    - **Left: Property Image** (medium size)
      - Status badge overlay (Active, Pending, etc.)
    
    - **Middle: Booking Details**
      - Property title (bold, large)
      - Location (with icon)
      - Booking ID: BOOK-XXX
      - Dates:
        - Start: [Date]
        - End: [Date]
        - Duration: [Calculated]
      - Total Amount: GH₵ X,XXX (large, colored)
      - Payment Status badge (Pending, Partial, Completed)
      - Booking Status badge (Pending, Confirmed, Completed, Cancelled)
    
    - **Right: Actions**
      - "View Details" button
      - "Make Payment" button (if balance due)
      - "View Receipt" button (if paid)
      - "Cancel Booking" button (if cancellable)
      - "..." dropdown menu:
        - View Property
        - Download Details
        - Contact Support

**D. Pagination or Infinite Scroll**

**E. Empty State:**
- If no bookings:
  - Icon (empty calendar)
  - Message: "You haven't made any bookings yet"
  - "Browse Properties" button (large, primary)

---

### 26. CLIENT - VIEW BOOKING DETAILS PAGE
**URL:** `/client/bookings/view.php?id=123`  
**Access:** Client only (can only view own bookings)

#### Page Structure:

**A. Page Header:**
- Title: "Booking Details"
- Booking ID: BOOK-123
- Breadcrumb: Dashboard > My Bookings > BOOK-123
- Action buttons:
  - "Print Details" button
  - "Download PDF" button
  - "Cancel Booking" button (red, if cancellable)

**B. Layout: 2 Columns**

**Left Column:**

**Card 1: Booking Status**
- Large status badge (current status)
- Status timeline:
  - Booking Created ✓
  - Payment Pending/Completed
  - Booking Confirmed/Pending
  - Move-in Date
  - Booking Completed

**Card 2: Property Information**
- Property image
- Property title (clickable to view property)
- Property type
- Location
- "View Property Details" link

**Card 3: Booking Information**
- Booking ID
- Booking Date
- Start Date (Move-in)
- End Date (Move-out)
- Duration
- Total Amount
- Special Requests (if any)

**Card 4: Payment Information**
- Total Booking Amount: GH₵ X,XXX
- Amount Paid: GH₵ X,XXX
- Balance Due: GH₵ X,XXX
- Payment Method
- Payment History Table:
  - Date | Amount | Method | Status | Receipt
  - Show all payments made
  - "View Receipt" links

**Right Column:**

**Card 1: Quick Actions**
- "Make Payment" button (large, if balance due)
- "View Receipt" button (if payment completed)
- "View Property" button
- "Contact Support" button
- "Cancel Booking" button (if allowed)

**Card 2: Important Information**
- Check-in instructions
- Check-out instructions
- Contact information
- Emergency contact

**Card 3: Contact Support**
- Need help with this booking?
- Contact form or phone number
- "Send Message" button

---

### 27. CLIENT - MY PAYMENTS PAGE
**URL:** `/client/payments/index.php`  
**Access:** Client only

#### Page Structure:

**A. Page Header:**
- Title: "My Payments"
- Breadcrumb: Dashboard > My Payments
- Statistics:
  - Total Paid: GH₵ XX,XXX
  - Pending Payments: X
  - This Month: GH₵ X,XXX

**B. Filter Options:**
- Date range selector
- Payment status filter (All, Verified, Pending)
- Booking selector (filter by specific booking)

**C. Payments Table:**
- **Columns:**
  1. **Date** (format: "15 Jan 2024")
  2. **Payment ID** (e.g., PAY-123)
  3. **Booking ID** (clickable link)
  4. **Property** (title + location)
  5. **Amount** (large, bold, colored)
  6. **Method** (badge)
  7. **Status** (badge: Pending, Verified)
  8. **Actions**
     - View Receipt (if verified)
     - View Details
     - Download PDF

**D. Payment Cards (Alternative to table on mobile):**
- Card per payment
- Horizontal layout
- Same information as table

**E. Pagination**

**F. Empty State:**
- If no payments:
  - Message: "You haven't made any payments yet"

---

### 28. CLIENT - VIEW PAYMENT RECEIPT PAGE
**URL:** `/client/payments/receipt.php?id=123`  
**Access:** Client only (can only view own receipts)

#### Page Structure:

**A. Similar to Admin Payment Receipt**
- Simplified version
- Client-facing design
- "Download PDF" button
- "Print" button
- "Back to Payments" button

**B. Receipt shows:**
- All payment details
- Booking information
- Property information
- Amount paid
- Balance (if any)

---

### 29. CLIENT - SAVED PROPERTIES PAGE (Optional)
**URL:** `/client/properties/saved.php`  
**Access:** Client only

#### Page Structure:

**A. Page Header:**
- Title: "Saved Properties"
- Count: "You have 8 saved properties"
- Breadcrumb: Dashboard > Saved Properties

**B. Properties Grid:**
- Same as browse properties
- Each card has:
  - Filled heart icon
  - "Remove" option (X button or unfill heart)
  - "Book Now" button
  - "View Details" link

**C. Empty State:**
- If no saved properties:
  - Icon (empty heart)
  - Message: "You haven't saved any properties yet"
  - "Browse Properties" button

---

### 30. CLIENT - PROFILE/SETTINGS PAGE
**URL:** `/client/profile.php`  
**Access:** Client only

#### Page Structure:

**A. Tabs:**
- Personal Information
- Security
- Notifications (Optional)

**B. Personal Information Tab:**
- Profile photo
  - Upload button
  - Remove button
- Form:
  - Full Name
  - Email (read-only or with verification)
  - Phone Number
  - Address (optional)
  - City
  - State
- "Save Changes" button

**C. Security Tab:**
- Current Password
- New Password
- Confirm New Password
- Password requirements display
- "Update Password" button

**D. Notifications Tab (Optional):**
- Email notification preferences:
  - [ ] Booking confirmations
  - [ ] Payment receipts
  - [ ] Property recommendations
  - [ ] Promotional emails
- "Save Preferences" button

---

## 🧩 SHARED COMPONENTS

### Navigation Bar Component
- Responsive (hamburger menu on mobile)
- Logo/brand (clickable to home)
- Navigation links
- User profile dropdown
- Notifications dropdown (optional)
- Search bar (optional)

### Footer Component
- Responsive (stacked on mobile)
- Columns: About, Links, Contact, Newsletter
- Social media icons
- Copyright text
- Back to top button

### Property Card Component
- Reusable card design
- Image with badges
- Property details
- Price
- Specifications
- Action buttons
- Hover effects

### Status Badge Component
- Color-coded badges
- Different styles for different statuses:
  - Available: Green
  - Booked: Orange
  - Sold: Red
  - Pending: Yellow
  - Completed: Blue
  - Cancelled: Gray

### Alert/Notification Component
- Success alerts (green)
- Error alerts (red)
- Warning alerts (yellow)
- Info alerts (blue)
- Dismissible
- Auto-dismiss after X seconds

### Modal Component
- Confirmation modals
- Form modals
- Image gallery modal
- Lightbox for images

### Loading Component
- Spinner/Loader
- Skeleton screens for content loading
- Progress bars (optional)

### Pagination Component
- Previous/Next buttons
- Page numbers
- Items per page selector
- "Showing X-Y of Z" text

### Date Picker Component
- Calendar popup
- Date range selection
- Min/max date restrictions
- Format display

### Search Bar Component
- Text input
- Search icon
- Clear button
- Autocomplete suggestions (optional)

### Filter Panel Component
- Collapsible on mobile
- Multiple filter options
- Apply/Reset buttons
- Active filters display

---

## 📱 RESPONSIVE BEHAVIOR

### Breakpoints:
- **Mobile:** < 768px
- **Tablet:** 768px - 1024px
- **Desktop:** > 1024px

### Mobile Specific Changes:

**Navigation:**
- Hamburger menu
- Slide-out drawer for navigation
- Bottom navigation bar (optional)

**Dashboard:**
- Sidebar becomes horizontal tabs or drawer
- Statistics cards stack vertically
- Tables become cards
- Charts responsive/stacked

**Forms:**
- Full-width inputs
- Larger touch targets (min 44px)
- Sticky action buttons at bottom

**Property Cards:**
- Single column layout
- Larger images
- Stacked information

**Tables:**
- Horizontal scroll or card transformation
- Priority columns visible, others hidden behind "..." menu

**Modals:**
- Full-screen on mobile
- Bottom sheet style (optional)

---

## 🎨 DESIGN GUIDELINES

### Colors:
- **Primary:** #007bff (Blue)
- **Success:** #28a745 (Green)
- **Warning:** #ffc107 (Yellow)
- **Danger:** #dc3545 (Red)
- **Info:** #17a2b8 (Cyan)
- **Dark:** #343a40 (Dark Gray)
- **Light:** #f8f9fa (Light Gray)

### Typography:
- **Font Family:** System fonts or Bootstrap defaults
- **Headings:** 
  - H1: 2.5rem (40px)
  - H2: 2rem (32px)
  - H3: 1.75rem (28px)
  - H4: 1.5rem (24px)
- **Body:** 1rem (16px)
- **Small:** 0.875rem (14px)

### Spacing:
- Use Bootstrap spacing utilities
- Consistent padding: 15px, 20px, 30px
- Consistent margins: 15px, 20px, 30px

### Buttons:
- **Primary:** Filled, primary color
- **Secondary:** Outline, primary color
- **Sizes:** Small, Default, Large
- **States:** Normal, Hover, Active, Disabled
- **Loading state:** Show spinner

### Cards:
- White background
- Subtle shadow: `box-shadow: 0 2px 4px rgba(0,0,0,0.1)`
- Rounded corners: 8px
- Padding: 20px
- Hover effect: slight elevation

### Forms:
- Clear labels
- Placeholder text
- Validation states (error, success)
- Helper text
- Required indicators (*)
- Focus states

### Images:
- Aspect ratios maintained
- Lazy loading
- Placeholder while loading
- Alt text for accessibility

---

## ♿ ACCESSIBILITY CONSIDERATIONS

- **Semantic HTML:** Use proper heading hierarchy
- **ARIA labels:** For icons and buttons
- **Keyboard navigation:** All interactive elements accessible
- **Focus indicators:** Visible focus states
- **Alt text:** All images have descriptive alt text
- **Color contrast:** Meet WCAG AA standards
- **Form labels:** All inputs have associated labels
- **Error messages:** Screen reader accessible

---

## 🎯 KEY USER FLOWS

### Flow 1: New User Registration & First Booking
1. Land on homepage
2. Click "Register"
3. Fill registration form
4. Submit and redirected to login
5. Login with credentials
6. Redirected to client dashboard
7. Click "Browse Properties"
8. Search/filter for property
9. View property details
10. Click "Book Now"
11. Fill booking form
12. Confirm booking
13. See success message
14. Optionally make payment

### Flow 2: Admin Adding New Property
1. Login as admin
2. Go to "Properties" > "Add New"
3. Fill property details form
4. Upload images
5. Set price and specifications
6. Mark status as available
7. Click "Publish Property"
8. See success message
9. Property appears in listings

### Flow 3: Admin Recording Payment
1. Login as admin
2. Go to "Payments" > "Record Payment"
3. Select booking from dropdown
4. See booking details
5. Enter payment amount
6. Enter payment method
7. Enter transaction reference
8. Click "Record Payment"
9. See success message
10. Generate receipt
11. Print/download receipt

---

## 📸 ADDITIONAL NOTES

### Image Specifications:
- **Property Images:** 
  - Main: 1200x800px (landscape)
  - Thumbnails: 400x300px
  - Format: JPG, PNG
  - Max size: 5MB

- **Profile Photos:**
  - Size: 200x200px (square)
  - Format: JPG, PNG
  - Max size: 2MB

- **Logo:**
  - Size: 200x60px
  - Format: PNG with transparency
  - Max size: 500KB

### Loading States:
- Show skeleton screens while loading content
- Show spinners for button actions
- Show progress bars for file uploads
- Disable buttons during processing

### Empty States:
- Always provide helpful empty states
- Include relevant icon
- Clear message
- Call-to-action button

### Error Handling:
- User-friendly error messages
- Never show technical errors to users
- Provide suggestions for fixing errors
- Show error location in forms

---

This comprehensive UI specification document provides everything needed to design and build all screens in the Real Estate Management System. Each page is detailed with:
- Layout structure
- Components and elements
- Content specifications
- Interactions and actions
- Responsive behavior
- User flows

Use this as a complete reference for building the UI/UX! 🎨