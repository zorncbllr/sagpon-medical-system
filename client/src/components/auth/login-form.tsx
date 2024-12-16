import { Link } from "react-router-dom";
import { EnterIcon } from "@radix-ui/react-icons";
import { Button } from "../ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "../ui/card";
import { Input } from "../ui/input";
import { Label } from "../ui/label";
import BoxReveal from "../ui/box-reveal";
import { useForm } from "react-hook-form";

import * as z from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import Error from "../ui/error";
import { useLogin } from "../../services/users/mutations";

const schema = z.object({
  email: z
    .string()
    .nonempty("Email address is required")
    .email("Invalid email address"),
  password: z.string().nonempty("Password is required"),
});

export type LoginData = z.infer<typeof schema>;

export function LoginForm() {
  const {
    register,
    handleSubmit,
    setError,
    formState: { errors },
  } = useForm<LoginData>({
    resolver: zodResolver(schema),
  });

  const { mutate } = useLogin({ setError });

  const submitHandler = (data: LoginData) => {
    mutate(data);
  };

  return (
    <Card className="w-[24rem]">
      <form onSubmit={handleSubmit(submitHandler)}>
        <CardHeader>
          <BoxReveal duration={0.6} width="100%">
            <CardTitle className="flex items-center justify-between">
              <span>Login</span>
              <EnterIcon color="green" />
            </CardTitle>
          </BoxReveal>
        </CardHeader>
        <CardContent>
          <div className="grid gap-4">
            <BoxReveal duration={0.5} width="100%">
              <div className="grid gap-2">
                <Label htmlFor="email">Email</Label>
                <Input
                  id="email"
                  type="email"
                  placeholder="sample@example.com"
                  {...register("email")}
                />
                {errors.email && <Error>{errors.email.message}</Error>}
              </div>
            </BoxReveal>
            <BoxReveal duration={0.7} width="100%">
              <div className="grid gap-2">
                <div className="flex items-center">
                  <Label htmlFor="password">Password</Label>
                  <Link
                    to="/forgot-password"
                    className="ml-auto inline-block text-sm underline"
                  >
                    Forgot your password?
                  </Link>
                </div>
                <Input
                  id="password"
                  type="password"
                  {...register("password")}
                />
                {errors.password && <Error>{errors.password.message}</Error>}
              </div>
            </BoxReveal>
            <BoxReveal duration={0.6} width="100%">
              <div className="grid gap-4">
                <Button type="submit" className="w-full">
                  Login
                </Button>
              </div>
            </BoxReveal>
          </div>
          <BoxReveal duration={0.7} width="100%">
            <div className="mt-4 text-center text-sm">
              Don&apos;t have an account?{" "}
              <Link to="/register" className="underline">
                Sign up
              </Link>
            </div>
          </BoxReveal>
        </CardContent>
      </form>
    </Card>
  );
}
