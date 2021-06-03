# Overview

Support for SiteGround staging functionality for the WP Bakery plugin. This plugin is needed because WP Builder stores some urls in the url encoded for i.e. 

```
[vc_btn title="Click Here" shape="square" color="danger" size="sm" link="url:https%3A%2F%2Fexample.com%2F|||"]
```

and they are not being replaced with the staging url automatically.

# Deploy

Deployment is not yet done. For now, I use the following script:

```
scp ./plugin/*.php user@server:/path/to/wp/wp-content/plugins/sg-staging-support-for-wpbakery/
```

# Test

Run

```
phpunit tests

```