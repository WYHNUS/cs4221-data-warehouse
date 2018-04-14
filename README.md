# Data Warehouse

NUS CS4221 project which uses TPC-H benchmark to create a web-based data warehouse system.

## Setup

Follow online instructions for setting up LAPP.

Update environment variables for `db_name`, `user_name` and `user_pwd` in order to connect to database using PHP.

Use `bower install` to install dependencies.

## Development

To improve the cleanliness of the code base and the usefulness of commit history, please use a separate branch for each new feature, and squash all commits in development branch before merging into the master branch.

**Note:** If changes made by you would significantly affect other people's work, please notify them first and send merge request for review before merging into the master branch. 

Sample workflow:

- 1 . Assume you are in the master branch, create a new branch for development: `git checkout -b <development branch name>`

- 2 . You can perform arbitrary number of `git commit`, `git pull`, `git merge`, ... in developemnt branch to test out your feature.

- 3 . When you are satisfied with current development and ready to merge back to master branch, sync local master branch with remote master branch first, before sync current branch with master: 

  - `git checkout master`
  - `git pull origin master`
  - `git checkout <development branch name>`
  - `git merge master`

- 4 . Resolve merge conflicts if there are any.

- 5 . Go back to master branch and Squash git commits to ensure cleaness of git history: 

  - `git checkout master`
  - `git merge --squash <development branch name>`

- 6 . Commit: `git commit -a -m "<description of the main purpose of development branch>"`

- 7 . Synchronize remote git repo: `git push origin master` 
