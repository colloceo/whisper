# Whisper Platform - Laravel with Bootstrap

A comprehensive Laravel-based mental health and peer support application with AI integration, real-time chat, and database-driven content management.

## Features

- **Onboarding Flow**: Welcome screens with crisis disclaimer modal
- **Authentication**: Sign in/up with anonymous mode support
- **Home Dashboard**: Interactive mood tracking with weekly charts and daily check-ins
- **AI Journal**: Transform thoughts into positive insights using Groq AI (Llama3)
- **Peer Support**: Real-time community chatrooms with live message polling and persistent storage
- **Crisis Support**: Kenyan emergency contacts and interactive coping strategies
- **User Profile**: Settings with Bootstrap form controls and switches
- **Database Integration**: Full CRUD operations for all user data
- **Anonymous Support**: Complete functionality without registration required

## Technology Stack

- **Backend**: Laravel 11
- **Database**: MySQL with comprehensive data models
- **AI Integration**: Groq AI API with Llama3-8B model
- **Frontend**: Blade templates with Bootstrap 5
- **Styling**: Bootstrap 5 with custom CSS variables and glassmorphism effects
- **JavaScript**: Vanilla JS with real-time UI updates
- **Build Tool**: Vite
- **Icons**: Inline SVG icons

## Installation

1. Navigate to the project directory:
   ```bash
   cd c:\xampp\htdocs\news\whisper-platform
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Copy environment file:
   ```bash
   copy .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. Build assets:
   ```bash
   npm run build
   ```

## Running the Application

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

2. Visit `http://localhost:8000` in your browser

## Bootstrap Components Used

### Layout & Navigation
- **Container System**: Responsive containers with custom max-widths
- **Flexbox Utilities**: For layout and alignment
- **Fixed Bottom Navigation**: Custom bottom navigation bar

### Interactive Components
- **Modals**: Crisis disclaimer, chat interface, breathing exercises
- **Alerts**: Various alert types for notifications and guidelines
- **Cards**: Custom whisper-card class extending Bootstrap cards
- **Buttons**: Custom whisper-btn class with rounded styling
- **Form Controls**: Enhanced inputs, switches, and checkboxes

### Custom Bootstrap Extensions
- **Whisper Design System**: CSS variables for consistent theming
- **Custom Button Variants**: btn-whisper-blue, btn-whisper-warm, btn-whisper-calm
- **Enhanced Cards**: Glassmorphism effect with backdrop-filter
- **Responsive Design**: Mobile-first approach with Bootstrap breakpoints

## Database Models

- **JournalEntry**: User journal entries with mood tracking
- **Affirmation**: AI-generated insights with save/delete functionality
- **MoodEntry**: Daily mood tracking with intensity levels
- **SupportGroup**: Community support groups with online member counts
- **CommunityActivity**: Real-time activity feed for community interactions
- **ChatMessage**: Persistent chat messages across support groups

## Routes

### Pages
- `/` - Onboarding page with Bootstrap modal
- `/signin` - Sign in page with form validation
- `/signup` - Sign up page with terms checkbox
- `/home` - Dashboard with interactive mood tracking and weekly charts
- `/journal` - AI journal with real-time insight generation
- `/chatrooms` - Peer support with database-driven chat system
- `/crisis` - Crisis support with Kenyan emergency contacts and interactive exercises
- `/profile` - User profile with Bootstrap switches

### API Endpoints
- `POST /api/journal/save` - Save journal entries
- `POST /api/affirmation/generate` - Generate AI insights
- `POST /api/affirmation/save` - Save insights to collection
- `GET /api/affirmations/saved` - Retrieve saved insights
- `DELETE /api/affirmation/{id}` - Delete insights
- `POST /api/mood/save` - Save mood entries
- `GET /api/chat/{groupName}/messages` - Load chat messages (supports ?after= for polling)
- `POST /api/chat/send` - Send chat messages with real-time updates

## Design System

### Colors (CSS Variables)
- `--whisper-blue`: #b2cbf2 (Primary brand color)
- `--whisper-warm`: #FFCDB2 (Warm accent)
- `--whisper-purple`: #CDB4DB (Secondary accent)
- `--whisper-teal`: #A8DADC (Calming accent)

### Typography
- **Primary**: Inter font family
- **Secondary**: Poppins font family
- **Bootstrap Typography**: Responsive text sizing

### Components
- **Whisper Cards**: Glassmorphism with backdrop-blur
- **Rounded Buttons**: 50px border-radius for pill shape
- **Gradient Backgrounds**: CSS custom properties for consistency
- **Interactive States**: Hover and focus states with smooth transitions

## Key Features

### AI-Powered Mental Health Support
- **Groq AI Integration**: Uses Llama3-8B model for generating personalized insights
- **Dynamic Prompts**: 8 different prompt styles with contextual guidance
- **Real-time Generation**: Instant AI responses with 3D flip card animations
- **Insight Management**: Save, view, and delete AI-generated insights

### Advanced Mood Tracking
- **Interactive Dashboard**: Visual mood selection with intensity levels
- **Weekly Charts**: Graphical representation of mood patterns
- **Daily Check-ins**: Persistent mood data with notes
- **Anonymous Tracking**: Full functionality without user accounts

### Real-Time Community Support
- **Live Chat System**: Messages appear instantly without page refresh (2-second polling)
- **Persistent Chat**: Database-stored messages across sessions
- **Multiple Support Groups**: Anxiety, Depression, and General Wellness
- **Live Activity Feed**: Real-time community interactions
- **Anonymous Participation**: Safe, judgment-free communication
- **Auto-scroll**: Automatic scrolling to new messages
- **Smart Loading**: Efficient polling that only fetches new messages

### Crisis Support & Safety
- **Kenyan Emergency Contacts**: Real emergency hotlines (999, Befrienders Kenya +254 722 178 177, Child Helpline 116, GBV Centre 1195)
- **Interactive Coping Tools**: 4-7-8 breathing exercises and 5-4-3-2-1 grounding techniques
- **Professional Resources**: Links to Basic Needs Kenya and Mental Health Kenya organizations
- **Anonymous Mode**: Complete functionality without registration
- **Session-based Identity**: Secure user identification using Laravel sessions
- **Safe Space Guidelines**: Community standards with moderation features

## Bootstrap Customization

### Custom CSS Classes
```css
.whisper-card - Enhanced Bootstrap card with glassmorphism
.whisper-btn - Custom button styling with pill shape
.btn-whisper-* - Custom button color variants
.bottom-nav - Fixed bottom navigation component
.mood-btn - Interactive mood selection buttons
.breathing-circle - Animated breathing exercise component
```

### Responsive Design
- Mobile-first approach using Bootstrap's grid system
- Custom container max-widths for optimal mobile experience
- Responsive modals that adapt to screen size
- Touch-friendly interactive elements

## Development

### Database Setup
```bash
php artisan migrate           # Run all migrations
php artisan db:seed --class=SupportGroupSeeder  # Seed initial data
```

### Building Assets
```bash
npm run build    # Production build
npm run dev      # Development build with watch
```

### Laravel Commands
```bash
php artisan serve              # Start development server
php artisan migrate           # Run database migrations
php artisan config:clear      # Clear configuration cache
php artisan tinker            # Interactive shell for testing
```

### Environment Configuration
```bash
# Required environment variables
AI_API_URL=https://api.groq.com/openai/v1/chat/completions
APP_TIMEZONE=Africa/Nairobi
DB_CONNECTION=mysql
```

## Performance & Compatibility

### Browser Support
- Modern browsers with CSS custom properties support
- Bootstrap 5 browser compatibility
- Backdrop-filter support for glassmorphism effects
- Touch device optimization for mobile users

### Performance Features
- **Lazy Loading**: Dynamic content loading for better performance
- **Real-time Updates**: Instant UI changes without page refreshes
- **Smart Message Polling**: Efficient 2-second polling that only fetches new messages
- **Optimized Queries**: Efficient database operations with proper indexing
- **Session Management**: Lightweight user identification system
- **Asset Optimization**: Vite-powered build system for fast loading
- **Memory Management**: Automatic cleanup of polling intervals when chat is closed

## Recent Updates

### Version 2.0 Features
- **Groq AI Integration**: Replaced previous AI service with Groq's Llama3 model
- **Real-time Chat System**: Live message polling with instant updates (no page refresh)
- **Enhanced Mood Tracking**: Weekly charts and comprehensive mood analytics
- **Instant UI Updates**: No-refresh saving and loading of insights and reflections
- **Community Activity Feed**: Live updates from user interactions
- **Improved Anonymous Support**: Full feature access without registration
- **Live Message Polling**: Messages appear automatically every 2 seconds

### Technical Improvements
- **Database Architecture**: Comprehensive models for all user data
- **API-First Design**: RESTful endpoints for all major operations
- **Vanilla JavaScript**: Removed Bootstrap JS dependencies for better performance
- **Enhanced Security**: CSRF protection and session-based authentication
- **Responsive Design**: Mobile-first approach with touch-friendly interactions

## Contributing

This project demonstrates modern Laravel development with AI integration, real-time features, and comprehensive database design. It showcases best practices for mental health applications including privacy protection, anonymous user support, and crisis intervention resources.

## License

This project is for educational and demonstration purposes, showcasing advanced Laravel development with AI integration, real-time chat systems, and comprehensive mental health support features.