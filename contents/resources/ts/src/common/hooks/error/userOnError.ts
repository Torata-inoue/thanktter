import { useCallback } from 'react';

type UseErrorHandlerType = () => (error: Error, info: { componentStack: string }) => void;
export const useErrorHandler: UseErrorHandlerType = () =>
  useCallback((error: Error) => {
    // TODO あとでエラーメッセージ処理作る
    console.log(error);
    alert('useErrorHandler内エラー');
  }, []);
