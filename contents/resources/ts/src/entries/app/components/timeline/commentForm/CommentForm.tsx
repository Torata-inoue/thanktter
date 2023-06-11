import React from 'react';
import {FormProvider, SubmitHandler} from "react-hook-form";
import {Button, Card, CardContent} from '@mui/material';
import {Send} from "@mui/icons-material";
import { SelectUser } from './selectUser/SelectUser';
import {CommentFormType, useCommentForm} from "../../../hooks/form/useCommentForm";
import {TextInput} from "./textInput/TextInput";
import {Form} from "../../form/Form";

export const CommentForm: React.FC = () => {
  const methods = useCommentForm();

  const onSubmitHandler: SubmitHandler<CommentFormType> = (data) => {
    console.log(data)
  }

  return (
    <Card>
      <CardContent>
        <FormProvider {...methods}>
          <Form<CommentFormType> onSubmit={onSubmitHandler}>
            <SelectUser />
            <TextInput />
            <Button type="submit" variant="contained" endIcon={<Send />}>
              送信する
            </Button>
          </Form>
        </FormProvider>
      </CardContent>
    </Card>
  );
};
