# 🎬 MovieFlix

A modern movie streaming web application built with Laravel 13, featuring movie browsing, video playback, file downloads, star ratings, and a full admin panel.

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Default Credentials](#default-credentials)
- [Project Structure](#project-structure)
- [User Roles & Permissions](#user-roles--permissions)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

MovieFlix is a study-focused Laravel web application that simulates a movie streaming platform. Users can browse movies, watch trailers, download content, and rate movies using a star rating system. Administrators have access to a dedicated dashboard to manage movies and monitor users.

---

## Features

### Public (Guest)
- Browse all movies in a responsive grid layout
- Search movies by title with auto-submit (no Enter key needed)
- Filter movies by genre with instant results
- Sort movies by **Latest** or **Top Rated**
- Watch movies using the built-in video player
- Download movies (public access)
- View average star ratings and total votes

### Authenticated Users
- All guest features
- Rate movies using a 1–5 star system
- One rating per movie per user
- Update existing rating at any time
- Real-time average rating update without page refresh

### Admin Panel
- Dedicated admin dashboard with stats (total movies, users, ratings)
- Latest movies and top rated movies overview
- Full movie management (Create, Read, Update, Delete)
- User management with ratings count per user
- Protected routes (admin only)

### Authentication
- Register with full name validation:
  - Letters only (no numbers or special characters)
  - First and last name required
  - Each name minimum 3 characters
  - Auto title-case formatting
  - Extra spaces automatically removed
- Login with email and password
- Password reset via email
- Password strength indicator on register
- Show/hide password toggle
- Remember me option

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 13 |
| Authentication | Laravel Breeze (Blade) |
| Frontend | Bootstrap 5.3 + Bootstrap Icons |
| Fonts | Google Fonts (Inter + Bebas Neue) |
| Database | MySQL |
| Templating | Laravel Blade |
| Styling | External CSS only (no inline/internal styles) |
| JavaScript | Vanilla JS + Fetch API |

---

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL >= 5.7
- Laravel CLI

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/movieflix.git
cd movieflix