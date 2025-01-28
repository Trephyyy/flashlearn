# FlashLearn - Interactive Learning Platform 🚀

[![Live Demo](https://img.shields.io/badge/Live-Demo-brightgreen)](https://flashlearn.mooo.com)
![GitHub](https://img.shields.io/github/license/trephyyy/flashlearn)

**FlashLearn** is a dynamic, user-centric learning platform designed to help users master new topics through interactive flashcards, quizzes, and spaced repetition. Built as a portfolio project, it showcases modern web development practices and a focus on seamless user experiences.

---

## Features ✨

- **Interactive Flashcards**: Create, edit, and organize flashcards.
- **Responsive Design**: Works flawlessly on desktop, tablet, and mobile.
- **User Authentication**: Secure signup/login with sessions.

---
## In development 💻 

- **Progress Tracking**: Visualize your learning journey with charts and statistics.
- **Spaced Repetition System (SRS)**: Optimize retention with AI-powered review scheduling.
- **Quiz Mode**: Test your knowledge with auto-generated quizzes.

---
## Technologies Used 🛠️

### Frontend
- **Framework**: [Vue 3](https://vuejs.org/) / [Inertia](https://inertiajs.com/)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/) + css

### Backend
- **Runtime**: [Node.js](https://nodejs.org/) + [Express](https://expressjs.com/)
- **Database**: [PostgreSQL](https://www.postgresql.org/)

### Deployment
- **Containerization**: [Docker](https://www.docker.com/)
- **Web Server**: [Nginx](https://www.nginx.com/)
- **Hosting**: [DigitalOcean](https://www.digitalocean.com/)

---

## Installation 💻

1. **Clone the repository**
   ```bash
   git clone     https://github.com/trephyyy/flashlearn.git
   cd flashlearn
   ```

2. **Install dependencies**
   ```bash
    npm i
    composer install
   ```

3. **Connect database through .env**
   - add your database user and password in the .env
   - make sure there is a `flashlearn` table in the db

4. **Migrate the database**
   ```bash
    php artisan migrate
   ```

5. **Generate app key**
   ```bash
    php artisan key:generate
   ```

6. **Start development server**
   ```bash
    php artisan serve
    npm run dev   
   ```