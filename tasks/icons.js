'use strict';

module.exports = function(gulp, $, config, slug) {

  var name = slug(config.iconsFontName).toLowerCase();

 /*
  * Build icons font and stylesheets
  */
  gulp.task('icons', function(){
    gulp.src(config.assets + 'icons/**/*')
      .pipe($.iconfont({
        fontName: name,
        appendCodepoints: true,
        normalize:true,
        fontHeight: 1001
      }))
      .on('codepoints', function(codepoints) {
        gulp.src('node_modules/toolbox-utils/templates/_icons.scss')
          .pipe($.consolidate('lodash', {
            glyphs: codepoints,
            fontName: name,
            fontPath: '../fonts/',
            className: name
          }))
          .pipe($.rename(name + '.scss'))
          .pipe(gulp.dest(config.assets + 'sass/'));
      })
      .pipe(gulp.dest(config.build + 'fonts'));
  });

};
