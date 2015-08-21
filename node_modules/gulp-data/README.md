# [gulp](https://github.com/wearefractal/gulp)-data

[![Build Status](https://travis-ci.org/colynb/gulp-data.svg?branch=master)](https://travis-ci.org/colynb/gulp-data)
[![Dependencies](https://david-dm.org/colynb/gulp-data.svg)](https://david-dm.org/colynb/gulp-data)

[![NPM](https://nodei.co/npm/gulp-data.svg?stars&downloads)](https://www.npmjs.com/package/gulp-data)

[Learn more about gulp.js, the streaming build system](http://gulpjs.com)

## Introduction

Gulp-data proposes a common API for attaching data to the file object for other plugins to consume. With gulp-data you can generate a data object from a variety of sources: json, front-matter, database, anything... and set it to the file object for other plugins to consume.

Many plugins, such as ```gulp-swig``` or ```gulp-jade``` allow for JSON data to be passed via their respective options parameter. However, frequently what you want is the ability to dynamically set the data based off the file name or some other attribute of the file. Without using another plugin, this becomes problematic - as the number of ways of getting at data (via JSON files, front-matter, data bases, promises, etc) increases, the more plugin authors have to update their APIs to support these sources. The ```gulp-data``` plugin aims to standardize a method that is generic enough to encapsulate these data sources into a single ```data``` property attached to the file object. It's really up to you as to where your data comes from, a JSON file, from a front-matter section of the file, or even a database, ```gulp-data``` doesn't really care.

However, for this to be effective, I'm asking plugin devs that receive data through the options parameter to make a small change to additionally accept this data through the ```file.data``` property. (See below)

## Important Update

Thanks to the help of [@izaakschroeder](http://www.github.com/izaakschroeder) we've reached version 1.0 (now 1.0.1). Some important changes have been added, primarily support for promises, and error handling. The examples below have been updated to reflect these changes.

## Usage

First, install `gulp-data` as a development dependency:

```shell
npm install --save-dev gulp-data
```

Then, add it to your `gulpfile.js`:

```javascript
var gulp = require('gulp');
var swig = require('gulp-swig');
var data = require('gulp-data');
var fm = require('front-matter');
var path = require('path');
var MongoClient = require('mongodb').MongoClient;

/*
  Get data via JSON file, keyed on filename.
*/
gulp.task('json-test', function() {
  return gulp.src('./examples/test1.html')
    .pipe(data(function(file) {
      return require('./examples/' + path.basename(file.path) + '.json');
    }))
    .pipe(swig())
    .pipe(gulp.dest('build'));
});

/*
  Get data via front matter
*/
gulp.task('fm-test', function() {
  return gulp.src('./examples/test2.html')
    .pipe(data(function(file) {
      var content = fm(String(file.contents));
      file.contents = new Buffer(content.body);
      return content.attributes;
    }))
    .pipe(swig())
    .pipe(gulp.dest('build'));
});

/*
  Get data via database, keyed on filename.
*/
gulp.task('db-test', function() {
  return gulp.src('./examples/test3.html')
    .pipe(data(function(file, cb) {
      MongoClient.connect('mongodb://127.0.0.1:27017/gulp-data-test', function(err, db) {
        if(err) return cb(err);
        cb(undefined, db.collection('file-data-test').findOne({filename: path.basename(file.path)}));
      });
    }))
    .pipe(swig())
    .pipe(gulp.dest('build'));
});

```

## API

### data(dataFunction)

#### dataFunction
Type: `Function`

Define a function that returns a data object via a callback function. Could return JSON from a file, or an object returned from a database.

You can return the data object:
```javascript
data(function(file) {
  return { 'foo': file.path }
})
```

You can return a promise:
```javascript
data(function(file) {
  return promise;
})
```

You can feed a result object through the callback:
```javascript
data(function(file, callback) {
  return callback(undefined, { 'foo': 'bar' });
})
```

You can feed a promise object through the callback:
```javascript
data(function(file, callback) {
  return callback(undefined, promise);
})
```

You can throw an error:
```javascript
data(function(file) {
  throw new Error('my-error');
})
```

You can raise an error via the callback:
```javascript
data(function(file, callback) {
  return callback('error');
})
```

## Note to gulp plugin authors

If your plugin needs a data object, one that normally gets passed in via your options parameter, I'm asking if you could please update the plugin to accept data from the ```file.data``` property. Here's how you can do it:

```gulp-swig``` usually accepts data via its ```options.data``` parameter, but with a small change, it checks to see if there's a ```file.data``` property and if so, merges it into the data object.

```
var data = opts.data || {};
if (file.data) {
  data = _.extend(file.data, data);
  // or just data = file.data if you don't care to merge. Up to you.
}
```

## Contributors

- [Colyn Brown](https://github.com/colynb)
- [Izaak Schroeder](https://github.com/izaakschroeder)


## License

[MIT License](http://en.wikipedia.org/wiki/MIT_License)
