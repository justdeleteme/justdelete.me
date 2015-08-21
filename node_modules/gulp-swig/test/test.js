var gulp = require('gulp');
var expect = require('chai').expect;
var task = require('../');
var es = require('event-stream');
var path = require('path');
var marked = require('swig-marked');

require('mocha');

describe('gulp-swig compilation', function() {

  'use strict';

  describe('gulp-swig', function() {

    var filename_with_layout = path.join(__dirname, './fixtures/test.html');
    var filename_without_layout = path.join(__dirname, './fixtures/test2.html');
    var filename_without_json = path.join(__dirname, './fixtures/test4.html');
    var filename_with_markdown = path.join(__dirname, './fixtures/test3.html');

    function expectStream(done, options) {
      options = options || {};
      return es.map(function(file) {
        var result = String(file.contents);
        var expected = options.expected;
        expect(result).to.equal(expected);
        done();
      });
    }

    it('should compile my swig files into HTML with data obj', function(done) {
      var opts = {
        data: {
          message1: 'hello'
        },
        expected: '<div class="layout">hello</div>'
      };
      gulp.src(filename_with_layout)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should compile my swig files into HTML with json file', function(done) {
      var opts = {
        load_json: true,
        expected: '<div class="layout">hello</div>'
      };
      gulp.src(filename_with_layout)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should continue without error if no json file was found when load_json is set to true', function(done) {
      var opts = {
        load_json: true,
        expected: 'world\n'
      };
      gulp.src(filename_without_json)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should compile my swig files into HTML with both data obj and json file', function(done) {
      var opts = {
        load_json: true,
        data: {
          message2: "world"
        },
        expected: '<div class="layout">helloworld</div>'
      };
      gulp.src(filename_with_layout)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should compile my swig files into HTML with json file from a defined path', function(done) {
      var opts = {
        load_json: true,
        json_path: path.join(__dirname, './fixtures/data/'),
        expected: '<div class="layout">hello from data</div>'
      };
      gulp.src(filename_with_layout)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should set swig defaults', function(done) {
      var opts = {
        defaults: {
          locals: {
            message1: "Hello World"
          }
        },
        expected: 'Hello World'
      };
      gulp.src(filename_without_layout)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should compile my swig files into HTML with data callback', function(done) {
      var opts = {
        data: function(file) {
          return {
            message1: path.basename(file.path)
          };
        },
        expected: '<div class="layout">test.html</div>'
      };
      gulp.src(filename_with_layout)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

    it('should compile markdown by defining a custom tag using opts.setup', function(done) {
      var opts = {
        setup: function(swig) {
          marked.useTag(swig, 'markdown');
        },
        expected: '<p><strong>hello</strong><br>world</p>\n'
      };
      gulp.src(filename_with_markdown)
        .pipe(task(opts))
        .pipe(expectStream(done, opts));
    });

  });

});
