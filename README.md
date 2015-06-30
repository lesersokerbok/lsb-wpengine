# Websites for Leser søker bok
Leser søker bok has three main websites:
* Home page (lesersokerbok.no)
* Boksøk (boksok.no) | A searchable directory of books reviewed by Leser søker bok.
* Ut av Hylla (utavhylla.wordpress.com) | A blog and resource center for "Bok for alle"-bibliotek.

This repository contains the code for the two first sites, the third runs on wordpress.com.

## Themes
There are three themes: 
* `lsb-base-theme`
* `lsb-lesersokerbok.no-theme`
* `lsb-boksok.no-theme`

Both `lsb-lesersokerbok.no-theme` and `lsb-boksok.no-theme` are child themes of `lsb-base-theme`.

The plan going forward is to move much of the functionality differences into plugins.

## Issues
Issues are tracked with [GitHub Issues](https://github.com/lesersokerbok/lsb-wordpress-themes/issues), but can also be viewed as a kanban board through [Huboard](https://huboard.com/lesersokerbok/lsb-wordpress-themes#/).

**[Huboard](https://huboard.com)**
is a kanban webservice for GitHub issues.  
Sign in using your GitHub account.

### Issue process
* When you start work on an issue add yourself as assignee. 
* Then pull the issue into the next appropriate lane if needed.
* When you are done with the work mark the issue as "ready for next stage".
* If you are having problems and/or need help mark the issue as "blocked".

Never push an issue into the next lane when you are done.

## Dev

### Branching strategy
Vincent Driessen's ["A successful Git branching model"](http://nvie.com/posts/a-successful-git-branching-model/). Also explained by Atlassian in an [article about different branching models](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow).

[Git Flow](https://github.com/nvie/gitflow) is used to simplify this process. However for larger feature branches **do not** finish by using git flow's `git flow feature finish <name>`. Instead push the feature branch to Git Hub and create a pull request for a teammate to review.

### Localization
Norwegian is used as the base language and all strings shuld be ready for translations. This is also true for backend code.

### Grunt
* Build assets while developing using `grunt dev`.
* Bulde assets for production with `grunt build`.

The Grunt script creates assets for all three themes.

### Debugging

Add / modify the following to wp-config.php:

```
define('WP_DEBUG',         true);  // Turn debugging ON
define('WP_DEBUG_DISPLAY', false); // Turn forced display OFF
define('WP_DEBUG_LOG',     true);  // Turn logging to wp-content/debug.log
define('WP_ENV', 'development');
```

Now you can use the ```_log(String)``` function, and monitor output in ```wp-content/debug.log```:

```
// In some php file:
<?php _log("I'm debugging!"); ?>

// In terminal:
$ tail -f wp-content/debug.log
[06-Aug-2014 10:46:30 UTC] I'm debugging!
```

The ```debug.log``` file is ignored by git.

## Test / Release
The sites are hosted at WPEnginge as multisite installs.

There are two installs:
* [lsbtest.wpengine.com](http://lsbtest.wpengine.com/): Used for testing purposes
* [lsb.wpengine.com](http://lsb.wpengine.com/): Used for production.

### Deployment
If you have not already done so go through the Initial Setup process.

#### Testing
Before finishing a feature branch or accepting a pull request test 
the changes at the `lsbtest` install.
* Build assets:  
`grunt build`
* Commit assets:  
`git commit -a -m "Assets built for testing"`
* Push to test:  
`git push lsbtest`

#### Realease
Releases and hotfixes should be tested at the `lsbtest` install before being
pushed to the `lsb` install.
* Create a release or hotfix branch:  
`git flow hotfix start <x.x.x>` or  
`git flow release start <x.x.x>`
* Update version number in `package.json` and check in:  
`git commit package.json -m "Bumped version number"`  
* Build assets:  
`grunt build`
* Commit assets:  
`git commit -a -m "Assets built for release/hotfix"`
* Push to test  
`git push lsbtest`
* Test the sites and if no errors are found finish the release or hotfix:  
`git flow hotfix finish <x.x.x>` or  
`git flow release finish <x.x.x>`
* Create snapshot of site on [my.wpengine.com](https://my.wpengine.com/installs/lsb/backup_points)
* Push to origin  
`git push -all`  
`git push -tags`
* Finally push to the `lsb` install:  
`git push lsbprod`

#### Initial Setup  
* Get push access e-mail Benedicte (raae@bgraphic.no) your SSH Public Key.
* Continue when you have gotten access to the installs, check by running:  
`ssh git@git.wpengine.com info`
* Add lsbtest as a remote:  
`git remote add lsbtest git@git.wpengine.com:production/lsbtest.git`
* Add lsb as a remote:  
`git remote add lsbprod git@git.wpengine.com:production/lsb.git`