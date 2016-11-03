var gulp = require('gulp');
    livereload = require('gulp-livereload');

gulp.task('livereload', function(){
  gulp.src('./**/*.php').pipe(livereload());
});

gulp.task('default',function(){
  livereload.listen();
  gulp.watch('./**/*.php', ['livereload'])
});
