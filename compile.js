const sass = require('sass');
const path = require('path');
const fs = require('fs');
const autoprefixer = require('autoprefixer')
const postcss = require('postcss')
const rtlCss = require('rtlcss');
const CleanCSS = require('clean-css');

const sassResult = sass.compile(
    './scss/template.scss',
    {
        loadPaths: [__dirname],
        sourceMap: true,
        sourceMapIncludeSources: true,
        style: 'expanded'}
);
const outputFile = 'template.css';
const rtlOutputFile = 'template-rtl.css';
const minifierOptions = {
    sourceMap: true,
    sourceMapInlineSources: true,
    rebase: true,
    rebaseTo: __dirname,
    format: {
        breakWith: 'lf',
    },
};
const outputFileMin = 'template.min.css';
const rtlOutputFileMin = 'template-rtl.min.css';

// Matches what comes out of the SASS CLI. Is not required. Just nice to be able to match up the outputs.
const finalCSS         = sassResult.css + '\n\n/*# sourceMappingURL=template.css.map */\n'
const sourceMap        = sassResult.sourceMap;

// Relative paths are not a supported option in the sass node api at the moment (it is supported in the cli). So do it by hand.
sourceMap.sources      = sourceMap.sources.map(str => str.replace('file://' + __dirname, '..'));
const mainFullPath     = path.resolve('./www/media/templates/site/osm/css/' + outputFile);
const autoPrefixResult = postcss([ autoprefixer({ cascade: false }) ]).process(finalCSS, {to: mainFullPath, map: {inline: false, prev: sourceMap, absolute: false}, from: __dirname + '/css/' + outputFile});

autoPrefixResult.warnings().forEach(warn => {
    console.warn(warn.toString())
})

fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + outputFile), autoPrefixResult.css);
fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + outputFile + '.map'), autoPrefixResult.map.toString());

const rtlFullPath = path.resolve('./www/media/templates/site/osm/css/' + rtlOutputFile)
const rtlResult = rtlCss.configure().process(autoPrefixResult.css, {to: rtlFullPath, map: {inline: false, prev: autoPrefixResult.map, absolute: false}})

rtlResult.warnings().forEach(warn => {
    console.warn(warn.toString())
})

fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + rtlOutputFile), rtlResult.css);
fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + rtlOutputFile + '.map'), rtlResult.map.toString());

new CleanCSS(minifierOptions)
    .minify(rtlResult.css, rtlResult.map.toString(), function (error, output) {
        if (output.warnings) {
            console.warn(output.warnings)
        }

        const minifiedCssFinished = `${output.styles}\n\n/*# sourceMappingURL=${rtlOutputFileMin}.map */\n`;
        fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + rtlOutputFileMin), minifiedCssFinished);
        fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + rtlOutputFileMin + '.map'), output.sourceMap.toString());
    });

new CleanCSS(minifierOptions)
    .minify(autoPrefixResult.css, autoPrefixResult.map.toString(), function (error, output) {
        if (output.warnings) {
            console.warn(output.warnings)
        }

        const minifiedCssFinished = `${output.styles}\n\n/*# sourceMappingURL=${outputFileMin}.map */\n`;

        fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + outputFileMin), minifiedCssFinished);
        fs.writeFileSync(path.resolve('./www/media/templates/site/osm/css/' + outputFileMin + '.map'), output.sourceMap.toString());
    });
