import { atom, selector, useRecoilValue } from 'recoil';
import { CommentType } from '../../constants/comment';
import { recoilKeys } from '../recoilKeys';
import { getCommentsAPI } from '../../features/comment/get';

const pageState = atom<number>({
  key: recoilKeys.APP_PAGE,
  default: 1,
});

const commentsSelector = selector<CommentType[]>({
  key: recoilKeys.APP_COMMENTS_SELECTOR,
  get: ({ get }) => {
    const page = get(pageState);
    return getCommentsAPI(page);
  },
});

type UseGetCommentsType = () => CommentType[];
export const useGetComments: UseGetCommentsType = () => useRecoilValue(commentsSelector);
