import { LoginForm } from "../components/auth/login-form";
import Logo from "../assets/logo";
import BoxReveal from "../components/ui/box-reveal";
import { useLayoutEffect } from "react";

function Login() {
  useLayoutEffect(() => {
    document.title = "Log In";
  }, []);

  return (
    <main className="w-full h-screen bg-white flex flex-col gap-4 items-center justify-center">
      <BoxReveal duration={0.4}>
        <Logo />
      </BoxReveal>
      <BoxReveal duration={0.6}>
        <h1 className="text-4xl font-semibold">Sagpon Health Station</h1>
      </BoxReveal>

      <BoxReveal duration={0.5}>
        <p className="text-center text-slate-500 before:content-[''] before:h-[0.1px] before:bg-slate-300 before:block before:m-4 after:content-[''] after:h-[0.1px] after:bg-slate-300 after:block after:m-4">
          Providing compassionate care and innovative solutions for a healthier
          community.
        </p>
      </BoxReveal>
      <BoxReveal duration={0.3}>
        <LoginForm />
      </BoxReveal>
    </main>
  );
}

export default Login;
