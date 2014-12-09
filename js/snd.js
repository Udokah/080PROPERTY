﻿ 
		   
		   function playSound(){
		   
		   var snd = new Audio(); 
		   snd.src = "data:audio/wav;base64," + "UklGRpQWAABXQVZFZm10IBAAAAABAAEAZysAAGcrAAABAAgAZGF0YXAWAACBgX+Cg4F/g4N2d4yCd4CEfYWJdX2FfHiEgHqBhoeCgnp+gICBfYJ/eX+BfHp/gX6AfH6BgH1+f35/gYF9d3R9f4B/fn16e36BfoB/e357e3qCe4CBfn19fn+Jfnx8fnx9gICGhHh0hI+Ie4R+d3uDg32Df3yAgYCFeH2IhXV1h4eHeoKCgIp7hXN5enR+coGBeHx/hIyGgo1+hIKEfYGAdHp2eYF5eX59foV7dISBfYGAfIWIeoKDgYd/ent5enp9eHZ2fIeDe3p6fImJhX5/fYGDhIV9fHN4e4R7fX9/e3h9hY6Dd3l9go2KhoJ7c3qGgX9+fXp2dH2FfnqDhn99gIKFiYV9eX1+hId/e3x5eXd3fn6BgH17foKDg4iFfHt9hYR8f398f3t1fYB+gIJ9d3qDg4CHhH+AgoSEfXyIhnp2fn91eoGDe3iDhH14hIeAgISDeX2DgYKCeXh+dXmEf3BqdXt7XWiBmJiFf4B1ZXSFZVqAlnVfanRqZWVohYt7i5aLcGp1dXWAi4x/dWVoX1pwdYCYmICBkIV1ZXSMmHt/gIB/X1poWl2QuZhwgJuLcGhUgJiLgIuFe3+AaF1of6GWhXt0gIFaT2hoWoG5UoWmUouMM3ShcJCWdH9of1pPaEN/i5hlcK6QdX9Sf4Bqi4WFf3B/dHBlXXSFloGMi3CLcF9fcIt7dH+AdZCAjIt1f4ubi4GMe39wdHtlaIF0i4mAj42PjIOMgX+AfXmHfXSYW5VuZZuJlSmktGc6k6iMSVjOemhfpa5fYZmVVnOZjF9zd3dzVn+PgGuVf3dziY9nf4CJYnqHfYZ5eYZubneDeXOBiWtth210gXl9g4x6d42DaI2PX3+ZaHeHa4OAbYd/eX19gYB0f4GAd3qDgYGGg4CMg3p9gIB6dIF9fXd5d3qBfYF9g4B/hn95gYCHgIOGd410f5lQpWV0m3ePXIaHdI9igY1/c4mVf3eJeo+ZdHmGgXd/dH13j3FuknmHemuJf1u6gUmocY16a5OHj2JfpZJ0iVWZfVWYgI1xUIx9mJtEW67JRkrJemhzk4luemiGn1V3koZ0aImPd3Ruh4l6d4yDc4yMcYGAkpN5cX2Dg4B/gH2AcYB9h3eJg3eHcYONgIF9f4N/gX+Gg3lzgH96hndzg3p9f3lxeYyAd4GAh4d6f4B9eYODboCBdIB/fXp5d3mNh3F3f3F6f3mDjIZ5d4aDfXd6ko93cXmAgHp3f4eHgXF3f4eMf4GDgIaGenqBf32Dh4N0f4GBd3eHh4F9end3enl6g4+Pf3d9h4B0bn+Thm59fXp5g4B5dG6Gf32Af42Df3l5enmAh4B6f4OHe3l8gIF9f4F9e3uAf3l8gIGAgIGBgoJ+f397en9/fICFhHx6f4SAfnyAhH57fYJ+gH17g4mCfnuHf4V9comDcnyGg4GAfn91fIODgn98gYN+f36Df4KAf4R9d3yIg35+gYR/fHt9goF+g4KDgHt8gIiDe4OGgXh8hIF9fHuDf3t9gYaEgX99fYOBfYF/f4eBfoSBfX5/gX+Bgnx/gX9/f4N/eoF/fH1+hoV9gYKAgIWGhIKAfn57fn56eXZ5fIGGh4eFg4KBen5/fYOBe3R4gn59fISEfnx8hoqAenx/dnh9f4F+fYaGe3eAfHJ7g314g4V3doKEf3+EgXt8gX96eX2AfXl6fHuChYiFgYOAenV9gnt5f4iDe3p9fn+BgoB9hYV5cHiAf3p7hYqGfnZ7goKBeX+AfXVteYSJhn2CgH96d36EioN7dnN4e3x+gYWFf3d1fYGFgH58fX93eH+BhYJ7ent+fYGDgoB6en59f358hIZ/fX59hIV/e3t7gnp3e4GLgHt4f4OCg3uCenp6doWBgnt7gH2AgYR9dXd4f4N8e3p/hIGDf3+Dgn52d3x+e3+GfXp9hoeBgH98e31/fnh8goGCg4KDfHh+gX58fHeDgICCgoF/gH5+fHmChoGEhXt5gISDf318eH+DeYCQg31+d4iIhHlvenyNhnJ5fYeOgXFueIeLfnZ2gY2MhHBvfYCCf357dIGLiIR5dnWAjHtyfImJgoB8fH99fYF+eH6LiXl2f35+gYKBf3x8iY17bn2Gg4d9cn6Jgnt+gX9+f36DiXyAh4N5eIWDfYCDgn1/f32Df4CAgX9/fXp/hIR6fHt5foeAe298eI+Gbnl3hol+end8g3d8eoOJfXh4fIN8foJ7e36De4J8e4uFeXh4f4WFeneBiYZ8enh8hYeBdn+Ji3N1gImIeHyBint4eoeBg4B+hYV6dISHgXiCgoZ9c4aBe4B+hIF7gYGAgH2DfneFhnR1h4J/foSDf3uAfnt+gYGAfoGCgISGfn1+gH18gYGDgIODg4B7e4GAgIR/hYGDg4F9f4KCgX9+gYSIgX12dnp+iI+RiIF2bm93hIiIioWBfXR/fXmDg4B4gnd/gpGEgHZxdXJ9gYqJhoB8eHV5foeFhH12c3qBhoeCgHdzdX2FiIuJgnt2dnuChYB+en6ChIaLh3V0eXh9jZSJgXx0cnh8hIqHgHx+hYqFfHl0c4CKi4mCenl2d4CFg4J/fYF+fX6CgHd3eX+EgH19hIpzdICEgHZ4fICCiIp3b36CgH16f4B+iIV9fH2AgH1+f4WFfHx8g4qHg4F/gX58fYF/gIWMioN/fnt7g4iEenqDh4SJhHt3doCTjnh7doKRiX1wbH6EjJB9dn2Bh4p9eHVxgIWChnt9h35+fnx8fXt9f4GGgn5+fHp3dn2Cg39+fIuMem55hnxzf4mEd4OIgXR7i4t4b36OiHeAgnx9fIKHg4B7d4CGg4J8en+BhIJ8e3t4fYSJg3l6gX+GfnV/d4Rwh35+fnWAf4eDfHd3fn2BfnyAe3x7foCAfYJ5goCAf3p3fX2CgH5+gH9/fnp/fIGDgnp5en+AgYeEgXp7e3x9e4OChIB7fYGBgX59f354gIODhH59f313e46Beod9g4Buh4NwfXZ7mXt4jHOBfGaGfXaKeIONc36BdYF3eop+e4CBh353dXqAf3uCi3+Le3x8dn94gH1/f3qNiol3c3+Ae3qCfXV7i4p/cIGLgX53goaBfXyCfX18fHeAiYKCg4eDd3d/hX11d4GJhIF/eXt8foR+cm+FiIl3b4WEfIF2b3h/ioJzb32JjH91dnx/gHt6enyAg4KBeXiAgHh3f4WFgoF/fnyAf395dICAgISEgoSDgn11dn17jX5+gHyKfnuBeomCfX98f3x9hIKAgXuFhX98dHuJg3x8hYiCfXp9hXhrb3iEkY6NhXx7cGxyfo2UhHp2dnZ0f4WSkn92cHJ7hYOGjIh6cGp2hIyNhIB7eHaBhoaCeXl+f3+EhIODfXl1doGIiYR+e36FhX55gIWBeXN0fYaMjIV7e32Bh4J8dnd/gH98fYCGiIJ9fX5/eXV3fYWFgn9+e3uAg4B6eX2Afn6HiH1ydoOGgXp3fYWAfISNhXd4f35/gX97gH57gYeHiIF1eIeKf315enmAfn6Hh4ODg3x+fH16fXx9hIuGf35/f394eH9/foGEhoOBfXt6en1+gYF8enqCh4SCfXl9fnp4fX2ChYF7dnyCgYJ/e32BgYOAgHp7fn9/gH57f4OHiH96enyCgYB8fHx/hoWBfnl+gYGBf397fH9/f3x+gH1+fXx8gYJ9ent7fn99eXp9e32Dfnd8gH99f356en+AfHt7e35+fX5+e3p8goB7eHt9gH99eXx+enx+fXuHjXheaYeelXZrf5KRf2lldISRjX5obZ2ejXRiepCNeGhofJibiXd0hY6AbGV+l456fYR+enmBiXptf5eKZ3iNeX2Ognp7enV5hYGCkn9weIN+eX2BgYmAeIR9dXt+dXqCgYWLgnh7gXp2enl/fXqFhn96foJ/eXl9goB/f3+Afn+BeoNyeox7iId+hXd1gXh5iHyEkIB8eHF+hX2Ge3+Fg3KAe31+gIOKe3R6foiGe3mGeXuCgX6Df4aAeXh9en2EfYyJgX58dnl/e3+CgIB/hIl9en59fIR8eX56f4uKenx/fH+Bg396fYKCfH1/gISDiYiBeG53hIiKgn9viYZ7gHmNg4Jwc4qChHeCgX1/f4J5f4mFfXd6g36AgH+Cf4SDiIFvdXp4hp6CZXqUfnhyoHxogoOOW5GPiV51oYVncqF3aYORg2uOim12hod8dICEfIaGbYiUcm+GkHZshYd8f4N/eYZ+d4CHgX5+eXCEi3t8hXd2io52coF7dod+eomAf3iGf3N9gH+Af36EhXp3gYd9eol3eIyDeoWBc3uKhoGCgHt4gYN+hYCGh3l3fYaBf4KFe3t8fYSHgoSGfXN8fn5/hYiIhX5+f3l4fYGHhYOEfoCAeH5+h4F+f39/gHt5f4GAgIKDfnp5fX+Dd4R7iX12fHiLfXaDgoiCdHl6goZ9eXp+gYODiXGEgn18c5B3fnt8g4GJe4B+iHx1fH5/g4Z+foKAeHWBh4Z/eIWIgH16enuAfoCChIOBg39+f358eX54houAh359hXZ+f3uGf3yGgYKBfoB8gIB9g4F9e39+gYOGhn98enR8hIKAfIOAeo2gjW5eaYeSiXNviZWCfnZ6g4t0dHuCjHaHeJR9Z4B8mHpoZ4ecjoZwbm9+jIKEdnF6gZCRd2xvcI6TiIBvbW97k4l8fXJveIyRdXiHfHZydYOLhXlweYOJj4FybXeNhnp5dH+JjIF0fYWDgXh2fYWIgnp8goiFgXx5gX59fn+Jjn92d4WFfnt8gHl3g4eDfX6BeIB+dXZ6g4F/gnx/f4GBem9zg4OCgYR+f4KAdGdxh5GNhHl9f4GHemlugI+Ng3h0eIOJgnt5doKKh356e3uAgoF7eHqDh4aHhIJ8cG1ygo6RjoN3dHd9fH+EioZ/e3l6f4ODgH1+fnh+fIWDg4B3eXl7g4KChYN4eHp/enuGhIJ7eXt+gIGEhYF3dnmCgoR+f396fH+Cg4CAfX55eoOEfXp7dXZ5g4eHhoSDf356fn99cnR0en6FiIiHhYSCf3t4eHd5fnp6hIeEgoeHgnx8eXl4gn94gYaFhH92dHx/fYGCfX2EhYN/fn17eG12gn+AiYuIiIF6end5eXx5e4GAhYh/g4SGgX18dHd3fICAg4WIhn9+gIB6eHx/goV+f4KCgX55fIV8e4aIioKCdnOGe3N5f4aFhIF9gYZ/eXx6foJ8foJ+e4OCf32BgH6EhoWBdXaAgXd8hH99hZCGfYSEeXeBf3d4goaFiYyHgYKBfHmBgYF8h4p9hox/eoCAgX+Bin6CgIaCenmAfoCJgIKFg4KAfIB4foB/gYGGfn1/f4KAh316gYCDenRzgJB8dYSRgnGAiX9udIiCc3eGiHx+hIN8eH6CfXR6iIB0f4mBdn+JhXl6g357foR/ZXuch258mIpob46Kc3qEgHl4h4p9eoGGgnZ4g4N4eX+Hi351eYOHhX99fnh6h4x9dHyBfn+FfneEg3h7h4N7eXZ8gIGAfXmDhnyCfH6CeHZ9hH16f4B5h4x6d4R4cYGAenuAhYSDgXx6eH6Bfnh9fHyGioB5fYWAfHN1gYd/f4CBgIF7fYKAdH2CdYF/foiDdXWHhHR7gnd1gYR+gH58f4F9fH99fnl9f3p/goF+eoWAcoKLfnd4fnmBgXd5e4OFg397fYF/end1gIV+fIWEgn9+fnp7fYGAe4OGf4B8hYN5gnmDf3uBfIR9f4GEf3Z9hHF5gXyAgoSCgn95fHd0eX9+gYN/gH99eHqBfnh8g3p3gH+Dh398e35+en16d4GGhH+DhIB+c314goCDgYJ+fYN9gHyAe3iBg4J7f4KCgHp+fX55f4WBfn2GgHt7fYB5fYCCgYKGgnx4enx+fXt/hXp3hYp4cImDcHGHgnV/hX19hH99fHRzhIp7eYWCfIODeYKBfIJ/eYCGe3qBgYF/gX+CgoF+f3t5f4SIgXWDhnx+h4J4eoKJgXZ7iId8e4KCf399gIF7doKNhnp6gYN8en2CgH2BgYF/fH6Bgn55fIN/fnt+gYGAgH18eoF/e3x/fHuAhIB2eIGBfnt8f4GCgHt8fn9/fX+DhYN7d3l8hoWBgH17fYKDfnt9en+ChoV/fn6Bf3l5gYKCfXx6fYKBgYCAgH19fn9/en2Ag4J/fX+Ag398eHp/g4SBfXyAgH5/gIGAe319f3+BgH19f4CBgXuBgISAeXx5f4SDg4CAgX+AfHp9f4OEgHyEfniNhnZ1hoR7f4J6gIaDgHt7foOAf39+fIB8gIN2f4l5eIV+d3+DenyAeoGEeHWBf3iDhHl/gnh6fHd8hoF7f354foV+foB3eYB/gomEfHp4eoCHhIF+dXuDg4GDf32Ee3uBf4aCgH55gYGBh39/gHx/foGAgYGBgIGBfn9+fXyAg4OGg3x8fH18gYSBgn9/f3t8fn+AgICAgH9+f357fH+Bf3yAhoR8en5+en2BhIV/fH6Af3t6gISAe3yDhH58fYB+enuDgoF+f4R+en2Bgn57gYSBf36BgX59f35+f4KDg399fX5+fn6Bf4B/goGBfX18fn2Af39+goCAfn59fH2Afn5/gH5/fn59fX+BgYF+e3+AfXyAf32Bg4B9fn9+f4CAf4B/foCAf39+gIB9f4CAfn2Bgn98fYCAfoCAf39/gX9/f39/gH57f4GBf3+BfX17fXx+g4SDfHuAfnx7fn6DfX5/f35/fHx/gYB9fnx9f36Af4CAfXx9foB/fn9+fH2Bg39/gICAfnx/gH1/gIJ/foGBgX5+f35/gYSBf35+f39/goGAf39/foCCgH5/fn6BgoF+f4B5gICAgHuCeoJ/fIB5gnx/fXqBfYR/fH56fn19fn+AfYB/enx+fn+Bfnt+f32Afn2Afn+Afn1/g39+fn1/goB+f32AgYF/fn+Af4CAfoCBgoF/fn1+f4KAf4CBgX99fH5/f4GCf31/fn59f36AgH9/fn59f39/f35/fn9+fX5/fn1/gH5/f399fH5+fX+Dgn19fH2Afn2AgH98fICAf39/fXx+f4GBgX18fX5+gYGAgIB+e36AgYGCgXyAgH6BfX+CgIKBgH95fYCBg4KBf398fH+CgH+CgX9+fX2Bgn+AhXtqkZJ5cneCioSDdnGDjYZ6coCJgX97eH+GhYN9eneEhoF4fICFiIJ1eICEgoV4gH6Ag4OCeXuCeoyDd4KBgXh4j4h5fHqBgnuEhX58doWNfnV4g4Z9fH+FhHl3goSBeXqDgH5/f4F+eH6Dgn97fYF9fYKCfX19f4B/f4B9fIKEfXp+goJ8gYR+fHt/goR/fH+Cgn1/foF/eoKDgX99goF+foGAfX+Cgn9+f4B+f4KAf4B+gIF/fn5/gH+Bgn5+gH9+fn5/f39+fn59f4CBf3x7e32CgoB/e3t/gH+Af319fX+Bf39/f35+fX9/f39/fn9/f359fn+AgIB+fX1/gICAf39+f3+Af39/f3+Af35/gICBgH5/f3+Af3+AgH9/fn+AgH9+fn9/f39/f39/fn9/f39/f35/f39+f3+Af39+f35+f39+f39/f39+fn9/fn9/fn9+f39/f39/fn9/f39/f39/f39/f35/f35/f39/f39/f39/f39/f39/f4B/f35/gIB/f35/f4B/f3+Af39/fw==";
		   
		   snd.play();
		   }