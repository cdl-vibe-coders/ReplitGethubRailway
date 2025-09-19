import { useState } from 'react'

function App() {
  const [count, setCount] = useState(0)

  return (
    <div className="min-h-screen bg-background text-foreground">
      <div className="container mx-auto px-4 py-8">
        <div className="flex flex-col items-center justify-center min-h-screen">
          <div className="text-center space-y-6">
            <h1 className="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
              Training Management Platform
            </h1>
            <p className="text-muted-foreground text-lg">
              Built with React, TypeScript, TailwindCSS & Laravel
            </p>
            <div className="flex items-center gap-4">
              <button
                onClick={() => setCount((count) => count + 1)}
                className="px-6 py-3 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors duration-200 font-medium"
              >
                Count: {count}
              </button>
              <div className="text-sm text-muted-foreground">
                Click to test reactivity
              </div>
            </div>
            <div className="grid grid-cols-2 gap-4 mt-8 text-sm">
              <div className="p-4 border rounded-lg bg-card">
                <h3 className="font-semibold text-card-foreground">Frontend</h3>
                <p className="text-muted-foreground mt-2">React + TypeScript + TailwindCSS</p>
              </div>
              <div className="p-4 border rounded-lg bg-card">
                <h3 className="font-semibold text-card-foreground">Backend</h3>
                <p className="text-muted-foreground mt-2">Laravel + PostgreSQL</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default App
