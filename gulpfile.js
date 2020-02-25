const { src, dest, watch, parallel, series } = require('gulp');

const pug = require('gulp-pug');
const pugbem = require('gulp-pugbem');

const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
// const rename = require("gulp-rename");

const { rollup } = require('rollup');
const { terser } = require('rollup-plugin-terser');

const browserSync = require('browser-sync').create();

sass.compiler = require('node-sass');

pugbem.b = true;

function html() {
  return src('src/pages/*.pug')
    .pipe(pug({
      plugins: [pugbem]
    }))
    .pipe(dest('./'))
    .pipe(browserSync.reload({stream: true}));
}

function serve() {
  browserSync.init({
    server: {
      baseDir: './' 
    }
  });
};

function watchTask() {
  watch(['src/components/**/*.scss', 'src/styles/*.scss'], css);
  watch(['src/components/**/*.pug', 'src/pages/*.pug'], html);
  watch(['src/components/*+/*.js', 'src/scripts/*.js'], series(js, reload));
}

function css() {
  return src('src/styles/main.scss')
  .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'})
      .on('error', sass.logError))
    // .pipe(postcss([autoprefixer()]))
    // .pipe(postcss([cssnano()]))
  .pipe(sourcemaps.write('./'))
  .pipe(dest('./'))
  .pipe(browserSync.reload({stream: true}));
}

async function js() {
  const outputConfig = {
    file: './script.js',
    format: 'iife',
    sourcemap: true,
    plugins: [terser()]
  };

  const bundle = await rollup({ input: './src/scripts/main.js' });
  return bundle.write(outputConfig);
}

function reload(cb) {
  browserSync.reload();
  cb();
}

exports.default = series(parallel(html, js, css), parallel(watchTask, serve));