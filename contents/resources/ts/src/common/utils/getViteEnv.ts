const envs = {
  endpoint: 'VITE_ENDPOINT',
} as const;

type NameType = keyof typeof envs;
type GetViteEnvType = (name: NameType) => string;
export const getViteEnv: GetViteEnvType = (name) => {
  const env = import.meta.env[envs[name]];
  if (!env) {
    throw Error('env not fond');
  }

  return env;
};
