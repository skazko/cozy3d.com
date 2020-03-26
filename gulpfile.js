const { src, dest, watch, parallel, series } = require('gulp');
const sass = require('gulp-sass');
const gcmq = require('gulp-group-css-media-queries');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const newer = require('gulp-newer');
const mode = require('gulp-mode')();

const del = require('del');
const { rollup } = require('rollup');
const { terser } = require('rollup-plugin-terser');
const multiInput = require('rollup-plugin-multi-input');

const browserSync = require('browser-sync').create();

sass.compiler = require('sass');

const dir = {
  src: 'src/',
  build: '../../../ospanel/OSPanel/domains/cozy.loc/wp-content/themes/kateslava/',
};

const php = {
  src: dir.src + 'templates/**/*.php',
  build: dir.build,
};

function phpTask() {
  return src(php.src)
    .pipe(newer(php.build))
    .pipe(dest(php.build))
}

const images = {
  src: dir.src + 'images/**/*',
  icons: dir.src + 'images/icons/*.svg',
  build: dir.build + 'img/'
};

function icons() {
  return src(images.icons)
    .pipe(newer(images.build))
    .pipe(rename({ prefix: 'icon-', extname: '.svg.php' }))
    .pipe(dest(images.build))
}

function imagesTask() {
  return src(images.src)
    .pipe(newer(images.build))
    .pipe(dest(images.build))
}

function serve() {
  browserSync.init({
    proxy: 'cozy.loc',
    files: dir.build + '/**/*',
    open: true,
    notify: false,
    ghostMode: false,
    ui: {
      port: 8001,
    },
  });
};

const css = {
  src: dir.src + 'styles/style.scss',
  watch: dir.src + 'styles/**/*',
  build: dir.build
}

function cssTask() {
  return src(css.src)
    .pipe(mode.development(sourcemaps.init()))
      .pipe(sass().on('error', sass.logError))
      // .pipe(gcmq())
      .pipe(postcss([autoprefixer()]))
      .pipe(mode.production(postcss([cssnano()])))
    .pipe(mode.development(sourcemaps.write('./')))
    .pipe(dest(css.build))
    .pipe(browserSync.reload({stream: true}));
}

const js = {
  src: dir.src + 'js/*.js',
  watch: dir.src + 'js/**/*',
  build: dir.build
}

async function jsTask() {
  const outputConfig = {
    dir: js.build,
    format: 'esm',
    sourcemap: mode.development(),
    plugins: mode.production() ? [ terser() ] : []
  };

  const bundle = await rollup({ 
    input: js.src, 
    plugins: [multiInput.default()]
   });
  return bundle.write(outputConfig);
}

function reload(cb) {
  browserSync.reload();
  cb();
}

function watchTask() {
  watch(css.watch, cssTask);
  watch(php.src, series(phpTask, reload));
  watch(images.src, series(imagesTask, icons, reload));
  watch(js.watch, series(jsTask, reload));
}

function clean() {
  return del([dir.build + '**', '!' + dir.build], {force: true})
}

exports.icons = icons;
exports.php = phpTask;
exports.img = imagesTask;
exports.css = cssTask;
exports.js = jsTask;
exports.clean = clean;
exports.build = series(clean, parallel(icons, phpTask, imagesTask, cssTask, jsTask));
exports.default = series(this.build, parallel(watchTask, serve));
