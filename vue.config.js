const path = require( 'path' );
const webpack = require( 'webpack' );

module.exports = {
  baseUrl: process.env.NODE_ENV === 'production'
    ? '/'
    : '/',
  productionSourceMap: false
}
