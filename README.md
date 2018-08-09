# WP Twitter

* Contributors: MrCarlLister
* Tags: twitter, api, cron job
* Requires at least: 3.0.1
* Tested up to: 4.9.7
* Stable tag: 4.3
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

Twitter plugin that uses Twitter API, cron job and shortcodes.

## Description

This is bare bones at the moment. But it works. Once you've activated plugin you can input your twitter api key etc and set a cron job for updating the feed.

Use ```[xtweets]``` shortcode for displaying tweets.

At the minute shortcode only accepts 1 argument; number of tweets. Default is 4.

e.g. 
```
[xtweets count=2]
```

You can edit mark-up output for tweets by copying *public/partials/templates/xtweets--single.php* to *your-theme/xtweets/xtweets--single.php*

There is no styling to date. This was always meant to be a companion to developers to quickly add a custom twitter feed to projects. I plan to add basic styling soon. Although there will be an option to disable.

### Installing

This section describes how to install the plugin and get it working.

1. Upload this folder to the */wp-content/plugins/* directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add access token, token secret, consumer key and consumer secret via Settings -> Twitter
4. Set cron job (this is how often feed is updated, results are cached in tweets.json file)
5. Place ```[xtweets]``` shortcode in your templates

## FAQs

Coming soon

### Screenshots

Comming soon

### Changelog

* 1.0.0 - Basic functionality in place and ready to launch
* 1.0.1 - Tweet caching now runs on initial settings save
