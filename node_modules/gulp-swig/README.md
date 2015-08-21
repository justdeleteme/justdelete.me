## Information

<table>
<tr>
<td>Package</td><td>gulp-swig</td>
</tr>
<tr>
<td>Description</td>
<td>Compile Swig templates</td>
</tr>
<tr>
<td>Node Version</td>
<td>≥ 0.8</td>
</tr>
<tr>
<td>Swig Version</td>
<td>1.4.*</td>
</tr>
</table>

[![Build Status](https://travis-ci.org/colynb/gulp-swig.png?branch=master)](https://travis-ci.org/colynb/gulp-swig)

[![NPM](https://nodei.co/npm/gulp-swig.png?stars&downloads)](https://npmjs.org/package/gulp-swig)

[Learn more about gulp.js, the streaming build system](http://gulpjs.com)

[Learn more about templating with Swig](http://paularmstrong.github.io/swig/)

## Install with NPM

```
$ npm install --save-dev gulp-swig
```

## Usage

Compile to HTML

```javascript
var swig = require('gulp-swig');

gulp.task('templates', function() {
  gulp.src('./lib/*.html')
    .pipe(swig())
    .pipe(gulp.dest('./dist/'))
});
```

### ** NEW **

Inject data into your templates via the new [gulp-data](https://npmjs.org/package/gulp-data) plugin. It creates a ```file.data``` property with the data you need. This new method makes it much easier and less restrictive for getting data, than the methods below it. I'd recommend using this new method.


```javascript
/*
  Get data via JSON file, keyed on filename.
*/
var swig = require('gulp-swig');
var data = require('gulp-data');

var getJsonData = function(file) {
  return require('./examples/' + path.basename(file.path) + '.json');
};

gulp.task('json-test', function() {
  return gulp.src('./examples/test1.html')
    .pipe(data(getJsonData))
    .pipe(swig())
    .pipe(gulp.dest('build'));
});
```

### ** PRE version 0.7.0 (but still works) **

Inject variables from data object into templates

```javascript
var swig = require('gulp-swig');
var opts = {
  data: {
    headline: "Welcome"
  }
};
gulp.task('templates', function() {
  gulp.src('./lib/*.html')
    .pipe(swig(opts))
    .pipe(gulp.dest('./dist/'))
});
```

Inject variables from JSON file into templates

If you've created a template called ```homepage.html``` you can create a JSON file called ```homepage.json``` to contain any variables you want injected into the template.

```javascript
var swig = require('gulp-swig');
var opts = {
  load_json: true
};
gulp.task('templates', function() {
  gulp.src('./lib/*.html')
    .pipe(swig(opts))
    .pipe(gulp.dest('./dist/'))
});
```

Inject variables from both a data object and JSON file into templates

```javascript
var swig = require('gulp-swig');
var opts = {
  load_json: true,
  data: {
    headline: "Welcome"
  }
};
gulp.task('templates', function() {
  gulp.src('./lib/*.html')
    .pipe(swig(opts))
    .pipe(gulp.dest('./dist/'))
});
```

By default, gulp-swig will look for the json data file in the same location as the template. If you have your data in a different location, there's an option for that:

```javascript
var swig = require('gulp-swig');
var opts = {
  load_json: true,
  json_path: './data/',
  data: {
    headline: "Welcome"
  }
};
gulp.task('templates', function() {
  gulp.src('./lib/*.html')
    .pipe(swig(opts))
    .pipe(gulp.dest('./dist/'))
});
```

Inject variables using the [Swig::setDefaults](http://paularmstrong.github.io/swig/docs/api/#setDefaults) method, and set other swig defaults.

```javascript
var swig = require('gulp-swig');
var opts = {
  defaults: { cache: false, locals: { site_name: "My Blog" } },
  data: {
    headline: "Welcome"
  }
};
gulp.task('templates', function() {
  gulp.src('./lib/*.html')
    .pipe(swig(opts))
    .pipe(gulp.dest('./dist/'))
});
```

Enable swig extensions using the setup option.

```javascript
var swig = require('gulp-swig');
var marked = require('swig-marked');
var opts = {
  setup: function(swig) {
    marked.useTag(swig, 'markdown');
  }
};
gulp.task('templates', function() {
  gulp.src('./lib/*.html') // containing markdown tag: {% markdown %}**hello**{% endmarkdown %}
    .pipe(swig(opts))
    .pipe(gulp.dest('./dist/'))
});
```



## LICENSE

(MIT License)

Copyright (c) 2013 Colyn Brown

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
