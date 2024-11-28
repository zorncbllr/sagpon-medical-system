import { useMutation } from "@tanstack/react-query";
import { UserLoginData } from "../interfaces/user-interface";
import { performLogin } from "./api";

export const useUserLogin = () =>
  useMutation({
    mutationKey: ["login"],
    mutationFn: (data: UserLoginData) => performLogin(data),
    onError: (error) => {
      console.log(error);
    },
    onSuccess: (data) => {
      console.log(data);
    },
  });

  

  
