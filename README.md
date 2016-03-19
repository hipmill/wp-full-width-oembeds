# wp-full-width-oembeds
Tiny WordPress plugin for adjusting the oEmbeds to the full-width of the article content. Code only affects iframes embedded via oEmbed and has notable effect on iframes of width lower than that of the content width, in which iframes would not be properly styled within the page.

Using this piece of code, iframes are styled at 100% of the content width, with height of proportion 56.25% of width. Styling is done entirely via CSS.

The recommended approach is to move the CSS to the style file containing the theme CSS.
