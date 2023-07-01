import { useCallback } from 'react';
import { atom, atomFamily, DefaultValue, selector, selectorFamily, useRecoilValue, useSetRecoilState } from 'recoil';
import { CommentType } from '../../constants/comment';
import { recoilKeys } from '../recoilKeys';
import { findCommentAPI, getCommentsAPI } from '../../features/comment/get';

const pageState = atom<number>({
  key: recoilKeys.APP_PAGE,
  default: 1,
});

const commentsState = atomFamily<CommentType[], number>({
  key: recoilKeys.APP_COMMENTS,
  default: (page) => getCommentsAPI(page),
});

const commentsSelector = selector<CommentType[]>({
  key: recoilKeys.APP_COMMENTS_SELECTOR,
  get: ({ get }) => {
    const page = get(pageState);
    return get(commentsState(page));
  },
  set: ({ set, get }, newValue) => {
    if (newValue instanceof DefaultValue) {
      return;
    }
    const page = get(pageState);
    set(commentsState(page), newValue);
  },
});

const commentSelector = selectorFamily<CommentType, number>({
  key: recoilKeys.APP_COMMENT_SELECTOR,
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
    ({ set, get }, newValue) => {
      if (newValue instanceof DefaultValue) {
        return;
      }
      const page = get(pageState);
      set(commentsState(page), (prevValue) =>
        prevValue.map((comment) => (comment.id === commentId ? newValue : comment))
      );
    },
});

type UseGetCommentsType = () => CommentType[];
export const useGetComments: UseGetCommentsType = () => useRecoilValue(commentsSelector);

type UseSetCommentType = (commentId: number) => (comment: CommentType) => void;
export const useSetComment: UseSetCommentType = (commentId) => {
  const setComment = useSetRecoilState(commentSelector(commentId));
  return useCallback(
    (comment) => {
      setComment(comment);
    },
    [setComment]
  );
};
