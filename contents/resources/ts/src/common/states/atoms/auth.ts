import { atom, useRecoilValue, useSetRecoilState } from 'recoil';
import { useCallback } from 'react';
import { findAuthApi } from '../../features/auth/authApi';
import { globalRecoilKeys } from '../globalRecoilKeys';
import { AuthType } from '../../constans/auth';

const authState = atom<AuthType>({
  key: globalRecoilKeys.USER,
  default: findAuthApi(),
});

type UseAuthType = () => AuthType;
export const useAuth: UseAuthType = () => useRecoilValue(authState);

type UseSetAuthType = () => (auth: AuthType) => void;
export const useSetAuth: UseSetAuthType = () => {
  const setAuth = useSetRecoilState(authState);
  return useCallback((auth) => setAuth(auth), [setAuth]);
};
