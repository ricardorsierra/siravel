var elixir = require('laravel-elixir');

require('laravel-elixir-vue-2')

elixir.config.publicPath = 'src/Assets/dist/';
elixir.config.assetsPath = 'src/Assets/';

elixir(function(mix) {
    mix.styles([
        '../packages/dropzone/basic.css',
        '../packages/dropzone/dropzone.css',
        '../packages/redactor/redactor.css',
        '../packages/datepicker/bootstrap-datetimepicker.css',
        'raw.min.css',
        'device.css',
        'main.css',
        'loaders.css',
        'modules.css',
    ]);

    mix.scripts([
        'bootstrap.min.js',
        'siravel.js',
        'forms.js',
        'typeahead.bundle.js',
        'bootstrap-tagsinput.min.js',
        '../packages/dropzone/dropzone.js',
        '../packages/datepicker/moment.js',
        '../packages/datepicker/bootstrap-datetimepicker.min.js',
        '../packages/redactor/redactor.js',
        '../packages/redactor/filemanager.js',
        '../packages/redactor/fontcolor.js',
        '../packages/redactor/fontfamily.js',
        '../packages/redactor/fontsize.js',
        '../packages/redactor/imagemanager.js',
        '../packages/redactor/stockimagemanager.js',
        '../packages/redactor/specialchar.js',
        '../packages/redactor/table.js',
        '../packages/redactor/video.js',

        'modules.js',
        'dropzone-custom.js',
    ]);

    // Themes
    mix.sass(
        [
            '../../PublishedAssets/Views/themes/default/assets/sass/_basic.scss',
            '../../PublishedAssets/Views/themes/default/assets/sass/_theme.scss'
        ],
        'src/PublishedAssets/Views/themes/default/assets/dist/layoult.css'
    );
    mix.scripts(
        [
            '../../PublishedAssets/Views/themes/default/assets/js/theme.js'
        ],
        'src/PublishedAssets/Views/themes/default/assets/dist/layoult.js'
    );
});
