# Theme Review Helper

Please do not install this plugin absolutely in the production environment!

This WordPress plugin provides following.

* Provides simple JSON API of the metadata for current theme.
* Catch JavaScript error and set `data-jserror` attribute to the `<body>`.

This plugin is designed for:
https://github.com/miya0001/wp-theme-spec

## Endpoints

### `/theme-meta/`

```
$ curl http://vccw.dev/theme-meta/ | jq .
{
  "name": "Twenty Sixteen",
  "version": "1.3",
  "stylesheet": "twentysixteen",
  "template": "twentysixteen",
  "textdomain": "twentysixteen",
  "is_textdomain_loaded": true
}
```

### `/theme-tags/`

```
$ curl http://vccw.dev/theme-tags/ | jq .
[
  "one-column",
  "two-columns",
  "right-sidebar",
  "accessibility-ready",
  "custom-background",
  "custom-colors",
  "custom-header",
  "custom-menu",
  "editor-style",
  "featured-images",
  "flexible-header",
  "microformats",
  "post-formats",
  "rtl-language-support",
  "sticky-post",
  "threaded-comments",
  "translation-ready",
  "blog"
]
```

### `/theme-features/`

```
$ curl http://vccw.dev/theme-features/ | jq .
{
  "automatic-feed-links": true,
  "title-tag": true,
  "custom-logo": [
    {
      "width": 240,
      "height": 240,
      "flex-width": false,
      "flex-height": true,
      "header-text": ""
    }
  ],
  "post-thumbnails": true,
  "menus": true,
  "html5": [
    [
      "search-form",
      "comment-form",
      "comment-list",
      "gallery",
      "caption"
    ]
  ],
  "post-formats": [
    [
      "aside",
      "image",
      "video",
      "quote",
      "link",
      "gallery",
      "status",
      "audio",
      "chat"
    ]
  ],
  "editor-style": true,
  "customize-selective-refresh-widgets": true,
  "custom-background": [
    {
      "default-image": "",
      "default-repeat": "repeat",
      "default-position-x": "left",
      "default-attachment": "scroll",
      "default-color": "1a1a1a",
      "wp-head-callback": "_custom_background_cb",
      "admin-head-callback": "",
      "admin-preview-callback": ""
    }
  ],
  "custom-header": [
    {
      "default-image": "",
      "random-default": false,
      "width": 1200,
      "height": 280,
      "flex-height": true,
      "flex-width": false,
      "default-text-color": "1a1a1a",
      "header-text": true,
      "uploads": true,
      "wp-head-callback": "twentysixteen_header_style",
      "admin-head-callback": "",
      "admin-preview-callback": ""
    }
  ],
  "widgets": true
}
```
