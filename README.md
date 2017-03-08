# team38
cpsc304 Database project

<h2> Introduction </h2> 
This is team 38's cpsc304 database project. The project is based roughly on an internship recruitment company that pairs students with industry companies for co-op positions. 

A few technologies you may want to use are XShell and XFTP both by NetSarang. XFTP helps transfers files between your computer and the ugrad server, and XShell lets your access the ugrad machine command line. 

<h1> Overall Setup </h1> 
Follow the steps below to setup the whole system. 

<h2> Setup Oracle Connection </h2> 
You'll first need to setup Oracle connection on your ugrad system. (Should be done for tutorial 7) 
Follow the link here to find out how to login to oracle db from ugrad machines: 
http://www.ugrad.cs.ubc.ca/~cs304/2014S1/tutorials/SQLPlus/SQLPlus.html


<h2> Setup PHP </h2> 
Follow the steps in "Setting up PHP" in this link: 
http://www.ugrad.cs.ubc.ca/~cs304/2014S1/php/index.html

Then follow the steps in "Getting PHP accessing Oracle" steps (Same link as before) 
<b>Note, use test.php in the github repository, as the test.txt on the webpage does not work </b>


<h2> Setting up Github inside ugrad machine </h2> 
At this point, you should have a public_html folder in the root dir of your user account. Since public_html is the folder where Apache web server reads the webpages, we'll need to have all our files inside the folder. The ugrad server will come with git installed, so follow the commands below to setup: 

First you want to initalize a git repository in public_htmt

``` 
cd public_html
git init 
```

Then you want to pull the github repository into the publc_html folder: 

```
git clone https://github.com/nathanmcsu/team38.git
```

Doing an "ls" command should show a team38 folder inside the public_html directory. 
Since you are pulling from a remote repo, your local machine may not have execute or write priviledges, to change that you'll need to run these commands: 
```
chmod 755 -R team38
``` 
The -R is to recursively give permission to everything inside team38 folder. 
Or you can navigate inside the team38 folder and give permission to everything inside with these two commands: 

``` 
cd team38
chmod 755 * -R 
``` 

Now to test if everything works, navigate to these two urls, since we are inside a folder we need to add another parameter inside our url to access these files. 

To test if PHP/Apache web server works go to this URL
```
http://www.ugrad.cs.ubc.ca/~{CS_ID}/team38/hello.php
```
<b> Replace {CS_ID} with your own cs id, e.g "a1b2" </b> 

<i>You'll need to modify test.php to connect to oracle through your own credentials, it may work with mine but I haven't tested it on your machine. </i>
To test if the PHP server can connect to Oracle access this URL: 
```
http://www.ugrad.cs.ubc.ca/~{CS_ID}/team38/test.php
```
Both sites should give you the same results as the previous two setups when everything was still in public_html root. 


<h1> Development </h1> 

So to contribute and do the project, there may be a couple things you'll need to do.
First, any new php files you make will need the execute permission for Apache web server to run it. If you transfer the .php file from your own computer into ugrad, it'll most likely be read-only. 

Remember to pull from github to update your repo periodically: 
``` 
cd team38
git pull 
``` 

When you do pull, remember you will need to give the new php files execute permission to run on your own server to test. 

``` 
cd public_html 
cd team38
chmod 755 * -R 
``` 


To push your changes to the github repo just follow the commands below: 
``` 
git add . 
git commit . -m "MESSAGE ON WHAT YOU DID" 
git push 
``` 
<b> You cannot push to github if your repo is not on the latest changes, git pull then git push to fix it </b> 
I recommend you if you are not familiar with git to do a quick hour or two video online to learn the commands, but most of the project will be basic push and pull to the master branch. You may need to search up how to resolve merge conflicts if that comes around. 

To access any of the new .php sites you can use the url below and replace with the file name: 
```
http://www.ugrad.cs.ubc.ca/~<CS_ID>/team38/{FILENAME}.php
``` 
