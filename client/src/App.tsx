import { Route, Routes } from "react-router-dom";
import { routes } from "./routes/__routes";
import Protector from "./components/auth/protector";
import LayoutProvider from "./components/layout";
import { Toaster } from "./components/ui/sonner";

function App() {
  return (
    <>
      <Routes>
        {routes.map(({ path, component: Component, isProtected }, index) => {
          if (isProtected) {
            return (
              <Route
                key={index}
                path={path}
                element={
                  <Protector>
                    <LayoutProvider>
                      <Component />
                    </LayoutProvider>
                  </Protector>
                }
              />
            );
          }

          return <Route key={index} path={path} element={<Component />} />;
        })}
      </Routes>
      <Toaster />
    </>
  );
}

export default App;
