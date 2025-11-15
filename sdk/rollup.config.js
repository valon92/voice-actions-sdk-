import terser from '@rollup/plugin-terser';

export default {
  input: 'src/index.js',
  output: [
    {
      file: 'dist/voice-actions-sdk.js',
      format: 'umd',
      name: 'VoiceActionsSDK',
      sourcemap: true,
      exports: 'named'
    },
    {
      file: 'dist/voice-actions-sdk.esm.js',
      format: 'es',
      sourcemap: true,
      exports: 'named'
    },
    {
      file: 'dist/voice-actions-sdk.min.js',
      format: 'umd',
      name: 'VoiceActionsSDK',
      plugins: [terser()],
      sourcemap: true,
      exports: 'named'
    }
  ]
};

