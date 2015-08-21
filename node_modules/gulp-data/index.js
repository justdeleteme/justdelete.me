var extend = require('util-extend');
var through = require('through2');
var gutil = require('gulp-util');

module.exports = function(data) {
  'use strict';

  // if necessary check for required param(s), e.g. options hash, etc.
  if (!data) {
    throw new gutil.PluginError('gulp-data', 'No data supplied');
  }

  // see 'Writing a plugin'
  // https://github.com/gulpjs/gulp/blob/master/docs/writing-a-plugin/README.md

  function gulpData(file, enc, callback) {
    /*jshint validthis:true*/
    var self = this, called = false;

    function handle(err, result){
      // extra guard in case
      if (called) {
        return;
      }
      called = true;
      if (err) {
        self.emit('error', new gutil.PluginError('gulp-data', { message: err }));
        return callback();
      }
      file.data = extend(file.data || {}, result);
      self.push(file);
      callback();
    }

    function local(data) {
      if (data && typeof data.then === 'function') {
        data.then(function(data){
          return handle(undefined, data);
        }, function(err) { return handle(err); });
      }
      else {
        handle(undefined, data);
      }
    }

    var res = null;
    if (typeof data === 'function') {
      try {
        res = data(file, handle);
        if (data.length <= 1) {
          local(res);
        }

      } catch(e) {
        handle(e);
      }
      return;
    }

    local(data);
  }

  return through.obj(gulpData);
};
