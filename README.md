## 10-min Diary

### Demo
- [Heruko Deployed Link](https://ten-min-diary.herokuapp.com/login)
- [Zoom Video Walkthrough](https://ten-min-diary.herokuapp.com/login)

### The Database
- Database Diagram is created by draw.io in google drive <br />
- <img src="https://github.com/YingzheLiu/10-min-diary/blob/master/databaseDiagram.png" width="600" height="550">

### The Application
Build an application using Laravel with the following requirements:

- There are 6 GET routes
    - GET `/diaries`, `/diaries/create`, `/diaries/{id}/edit`, `/diaries/{id}/delete`, `/todos`, `/about`        
- There is an about page at `/about` that explains the goal/mission of the site
- There are 6 POST routes
    - POST `/diaries`, `/diaries/{id}`, `/diaries/{id}/delete`, `/todos`, `/todos/save`, `/about` 
- Pages where users can create, edit, and delete data
    - Users can create, edit and delete `diaries`
    - Users can create and delete `todos` on the To-Do list
    - Users can create `comments` for the application
- Server-side validation with Laravel’s validation rules
    - User Laravel validation rules: `required`, `min`, `exists`   
    - There are two [custom validation rules](https://laravel.com/docs/8.x/validation#custom-validation-rules): `maxwords` and `HasntPostToday`  
- Whenever there is a form submission and the validation failed, error messages as flashed session data will be displayed under the specific fields.
- Form submissions that fail validation should repopulate the form with the user’s input
- Notifications are displayed for when inserts, updates, and deletions are successful with `toastr`
- Authentication - Sign up, Login, and Logout with Laravel [starter kits](https://laravel.com/docs/8.x/starter-kits)
- Blade templates that share a common layout `main.blade.php`
- The document title (the title tag) for each page is unique and contain meaningful, contextual data
- Eloquent and the Query Builder are used for all database access
- Pages are organized and have a consistent layout with Bootstrap

### Additional Feature
There is a commenting system from scratch for some resource in the application in the `/about` page. The comments in the commenting system should at the very least contain the commenter’s name, a comment body, and a time stamp. When comments are displayed, they are sorted from the most recent to the oldest
