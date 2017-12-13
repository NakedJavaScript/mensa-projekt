# mensa-projekt

## How to git

* Download git or use the git.exe in the folder
* Install it
* Clone the repo https://github.com/NakedJavaScript/mensa-projekt.git
* Do: `git config --global http.proxy http://proxyuser:proxypwd@proxy.its-stuttgart.de:3128`
  * Replace `proxyuser` with your its-stuttgart user (e.g nikolai.nowolodski)
  * Replace `proxypwd` with your its-stuttgart user password (e.g andreassucksdicks)
  * And you're done
* `git fetch` to check if there are new commits
* `git pull` to pull new commits on your branch
* `git checkout BRANCH` (checkout another branch)
* If you changed stuff and want to commit your stuff, do the following:
  * `git add --all` (adds all files or just do git add filename)
  * `git commit -m "Commit Message"` (commit your files and write a message about the changes or so)
  * `git push` (push your files into the repo)
* `git status` (check the status of your files (you have changes))

## Setup when using a school pc
* Delete your old xampp folder and install the latest version (can be found under: T:/Klasse E3FI1AT/SAE/projektgruppe_nn_jm_ah).
* Start Apache and Mysql with xampp
* Open Mysql and create a connection
* Create a new schema and import the latest data dumps
* Use any browser except firefox (a google installer is in the same folder as the xampp installer)
* Type "localhost/php/" to get to the index page
