import { atom, useRecoilValue, useSetRecoilState } from 'recoil';
import { useCallback } from 'react';
import { globalRecoilKeys } from '../globalRecoilKeys';
import { AuthType } from '../../constans/auth';
import { findAuthApi } from '../../features/auth/authApi';

const authState = atom<AuthType | null>({
  key: globalRecoilKeys.USER,
  default: findAuthApi(),
});

type UseAuthenticated = () => boolean;
export const useAuthenticated: UseAuthenticated = () => Boolean(useRecoilValue(authState));

type UseAuthType = () => AuthType;
export const useAuth: UseAuthType = () => {
  const auth = useRecoilValue(authState);
  if (!auth) {
    throw Error('ログインしてください');
  }
  return auth;
};

type UseSetAuthType = () => (auth: AuthType) => void;
export const useSetAuth: UseSetAuthType = () => {
  const setAuth = useSetRecoilState(authState);
  return useCallback((auth) => setAuth(auth), [setAuth]);
};
