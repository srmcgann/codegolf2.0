const { createCanvas, loadImage } = require('canvas')
const c = createCanvas(1920, 1080)
const thumb = createCanvas(250,250)
const x = c.getContext('2d')
const fetch = require('node-fetch')
const fs = require('fs');
const id = process.argv[2]
const startTime = (new Date()).getTime()

if(!id) {
  console.error('missing applet id!')
  process.exit();
}

console.log('generating thumbnail for applet #' + id)

  fetch('https://applet.codegolf.tk/demoSource.php?id=' + id).then(res=>res.json()).then(res=>{
    let code = res.code
    c.width = 1920;
    c.height = 1080;
    code = code.replace('c.cloneNode()', 'createCanvas(c.width, c.height)')
    var T = Math.tan;
    var S = Math.sin;
    var C = Math.cos;
    var time = 0;
    var frame = 0;
    function u(t){
      eval(code);
    }
    for(let i=0;i<256 && (new Date()).getTime() - startTime < 3000;++i){
      time = frame/60;
      frame++;
      u(time);
    }
    setTimeout(() => {
      let ctx = thumb.getContext('2d');
      thumb.width=512;
      thumb.height=512;
      ctx.fillStyle = '#fff'
      ctx.fillRect(0,0,thumb.width,thumb.height)
      ctx.drawImage(c,-thumb.width/(c.height/c.width)/4,0,thumb.width/(c.height/c.width),thumb.height);
      var img = thumb.toDataURL()
      var data = img.replace(/^data:image\/\w+;base64,/, "");
      var buf = new Buffer.from(data, 'base64');
      fs.writeFileSync(`thumbs/${id}.png`, buf);
    }, 0);
    function u(t){
      eval(code);
    }
  }).catch(function(error) {
    console.log('failed!');
    process.exit();
    //console.log(error);
  });
