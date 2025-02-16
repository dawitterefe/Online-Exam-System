# Online Exam System

An advanced online exam system built with Laravel and TailwindCSS. This project is role-based, catering to Admins, Teachers, Students, and Evaluators, with a custom user interface for a seamless experience.

## Features

- **Admin Role:**
  - Manage users

- **Teacher Role:**
  - Create
  - manage exams


- **Student Role:**
  -Take exams
  - View results.

- **Evaluator Role:**
  - Review exams
  - Provide feedback

## Technology Stack

- **Frontend:** TailwindCSS for elegant and responsive UI
- **Backend:** Laravel for robust and scalable server-side logic

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/dawitterefe/Online-Exam-System
   ```
2. Navigate to the project directory:
   ```bash
   cd online-exam-system
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Set up the environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Migrate the database:
   ```bash
   php artisan migrate
   ```
6. Run the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

## Usage

1. Access the system via `http://localhost:8000`.
2. Register as a new user which is Admin.

## Custom UI

The custom UI ensures a seamless user experience with intuitive navigation and responsive design. Built with TailwindCSS, it offers a modern and clean interface.

## Contributing

We welcome contributions to enhance this project. Feel free to fork the repository, make your changes, and submit a pull request.

---

Feel free to customize it further as needed! 😊
