import React, { useState } from 'react';
import { useFormContext, useWatch } from 'react-hook-form';
import { TextDiv } from '../../../../../../common/components/text/TextDiv';
import { CommentFormType } from '../../../../hooks/form/useCommentForm';
import { ImageList } from '../../image/ImageList';
import { ValidationMessage } from '../../../../../../common/components/form/ValidationMessage';

type ImageUploaderProps = { children: React.ReactNode };
export const ImageUploader: React.FC<ImageUploaderProps> = ({ children }) => {
  const [drag, setDrag] = useState<boolean>(false);
  const { setValue, getValues, control, trigger } = useFormContext<CommentFormType>();

  const imageFiles = useWatch<CommentFormType>({ control, name: 'images' }) as File[];
  const removeImage: (index: number) => void = (index) => {
    const prevValue = getValues('images');
    setValue(
      'images',
      prevValue.filter((_, i) => i !== index)
    );
  };

  const handleOnDragOver: React.DragEventHandler<HTMLDivElement> = (event) => {
    setDrag(true);
    event.preventDefault();
  };

  const handleOnDrop: React.DragEventHandler<HTMLDivElement> = (event) => {
    setValue('images', [...getValues('images'), ...event.dataTransfer.files]);
    setDrag(false);
    event.preventDefault();
    trigger('images').catch(() => '');
  };

  const handleOnDragLeave: React.DragEventHandler<HTMLDivElement> = () => {
    setDrag(false);
  };
  return (
    <>
      <div
        onDragOver={handleOnDragOver}
        onDrop={handleOnDrop}
        onDragLeave={handleOnDragLeave}
        style={{ border: drag ? 'solid 3px orange' : 'none' }}
      >
        {children}
      </div>
      <TextDiv textAlign="right">ドラッグ&ドロップで画像を挿入できます</TextDiv>
      <ImageList imageFiles={imageFiles} removeImage={removeImage} />
      <ValidationMessage<CommentFormType> name="images" />
    </>
  );
};
