import { useCallback } from 'react';
import { atom, DefaultValue, selector, selectorFamily, useRecoilValue, useSetRecoilState } from 'recoil';
import { CommentType } from '../../constants/comment';
import { recoilKeys } from '../recoilKeys';
import { findCommentAPI, getCommentsAPI } from '../../features/comment/get';

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
  set: ({ set }, newValue) => {
    if (newValue instanceof DefaultValue) {
      return;
    }
    set(commentsSelector, newValue);
  },
});

const commentState = selectorFamily<CommentType, number>({
  key: recoilKeys.APP_COMMENT,
  get:
    (commentId) =>
    ({ get }) => {
      const comment = get(commentsSelector).find(({ id }) => commentId === id);
      if (comment) {
        return comment;
      }
      return findCommentAPI(commentId);
    },
  set:
    (commentId) =>
    ({ set }, newValue) => {
      if (newValue instanceof DefaultValue) {
        return;
      }
      set(commentsSelector, (prevValue) => prevValue.map((comment) => (comment.id === commentId ? newValue : comment)));
    },
});

type UseGetCommentsType = () => CommentType[];
export const useGetComments: UseGetCommentsType = () => useRecoilValue(commentsSelector);

type UseSetCommentType = (commentId: number) => (comment: CommentType) => void;
export const useSetComment: UseSetCommentType = (commentId) => {
  const setComment = useSetRecoilState(commentState(commentId));
  return useCallback(
    (comment) => {
      setComment(comment);
    },
    [setComment]
  );
};
