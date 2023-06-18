import { atom, useRecoilValue } from 'recoil';
import { findAuthApi } from '../../features/auth/authApi';
import { globalRecoilKeys } from '../globalRecoilKeys';
import { AuthType } from '../../constans/auth';

const userState = atom<AuthType>({
  key: globalRecoilKeys.USER,
  default: findAuthApi(),
});

type UseAuthType = () => AuthType;
export const useAuth: UseAuthType = () => useRecoilValue(userState);
