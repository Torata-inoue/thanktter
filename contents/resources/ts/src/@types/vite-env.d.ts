/// <reference types="vite/client" />

interface ImportMetaEnv {
  VITE_ENDPOINT: string;
}

interface ImportMeta {
  readonly env: ImportMetaEnv;
}
