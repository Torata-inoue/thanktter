import { atom, useRecoilValue } from 'recoil';
import { AuthType, findAuthApi } from '../../features/auth/authApi';
import { globalRecoilKeys } from '../globalRecoilKeys';

const userState = atom<AuthType>({
  key: globalRecoilKeys.USER,
  default: findAuthApi(),
});

type UseAuthType = () => AuthType;
export const useAuth: UseAuthType = () => useRecoilValue(userState);
