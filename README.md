# A Twitter-esque Social Media Site
#### A Software Architecture Project

### Short 
<p align="center"><img src="https://imgur.com/k5yzWrL.png" width="100"></p>
The site is called Hummingbird, and the idea for it was to be a small challenge for the semester for me to create a light visual "dupe" of the older version of Twitter, with a few small differences. As someone with an interest in website design, this was quite fun to develop, obviously, with quite a few hurdles along the way.


### Developmental Iterations
During the project, there were four developmental iterations, each having 2 to 3 focus points, as per the requirement of the project for a single person. They go as follows:

#### Iteration I:
- The registration and login features for users;
- User authorisation (distinguishing roles, such as registered user, an unregistered guest and and admin);
- Creation of the administration panel (CRUD functionalities).
#### Iteration II:
- Creation of the main page (dynamic loading of the posts, sorted by creation date - newest to oldest);
- Implementation of the ability for a registered user to create a post.
#### Iteration III:
- Implementation of the delete and edit functionality for user's own posts;
- Addition of a comment section under every post, with the ability for users to leave comments.
#### Iteration IV:
- Implementation of the delete and edit functionality for user's own comments;
- Implementation of the "liking" feature for posts and comments;
- Making the comment section sorted by the given criteria:
  - Primary sorting based on the rating (amount of "likes" given) for each comment;
  - In case of a matching rating, the oldest comment will be displayed first, with newest comments displayed last.

### Installation

For the purposes of previewing this project, here are the steps (this is for a machine running on Windows, though I'm sure the steps for a Linux OS should be similar, if not identical):
- Download the program [XAMPP](https://www.apachefriends.org/download.html).
  - In the XAMPP file folder, navigate to *htdocs*, delete all existing files;
  - Clone the repository in the aforementioned folder;
  - In the *Apache* module row, select Config and select the first option (*Apache (httpd.conf)*);
  - Find the *DocumentRoot* portion of the text file, and change the path to the repository folder (should look like **DocumentRoot "../xampp/htdocs/SftwArchProject**"); do the same thing with the *Directory* line right below it;
  - Start the Apache and MySQL modules.
- Open the CMD command line, and enter the following commands:
  - `composer install` <- in case this command fails, check the bottom of this section (the part with the asterisk);
  - `copy .env.example .env`
  - `php artisan key:generate`
  - `php artisan migrate`
  - `php artisan storage:link`
  - `php artisan serve`
- Open another CMD line and enter the following commands:
  - `npm install`
  - `npm run dev`

Now the website should be hosted locally, the views displayed correctly and the database should be created and linked.

\* If the `composer install` command doesn't work properly, open XAMPP, then under the *Apache* module row select *PHP (php.ini)*, navigate to the part where it says `;extension=zip` and change it to `extension=zip`.

### Diagrams

#### The Activity Diagram
<p align="center"><img src="https://imgur.com/8GBnMP8.png" width="400"></p>

#### The Use Case Diagram
<p align="center"><img src="https://imgur.com/6yWSrKm.png" width="400"></p>

#### The Relational Diagram
<p align="center"><img src="https://i.imgur.com/a3ni61i.png" width="400"></p>
