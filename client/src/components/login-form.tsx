import { Link } from "react-router-dom";
import { EnterIcon } from "@radix-ui/react-icons";
import { Button } from "./ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "./ui/card";
import { Input } from "./ui/input";
import { Label } from "./ui/label";
import BoxReveal from "./ui/box-reveal";
import { FieldValues, useForm } from "react-hook-form";

export function LoginForm() {
  const { register, handleSubmit } = useForm();

  const submitHandler = (data: FieldValues) => {};

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
              </div>
            </BoxReveal>
            <BoxReveal duration={0.6} width="100%">
              <div className="grid gap-4">
                <Button type="submit" className="w-full">
                  Login
                </Button>
                <Button variant="outline" className="w-full">
                  Login with Google
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
